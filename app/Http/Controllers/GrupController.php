<?php

namespace App\Http\Controllers;

use App\GroupMember;
use Illuminate\Http\Request;
use App\GroupNgaji;
use App\RecitationProgres;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class GrupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $groupRecomData = GroupNgaji::limit(3)->get();
        $groupNewestData = GroupNgaji::orderByDesc('created_at')->limit(10)->get();
        $groupUsersData = GroupNgaji::join('detail_group_ngajis', 'detail_group_ngajis.group_ngaji_id', 'group_ngajis.id')->where('detail_group_ngajis.user_id', Auth::user()->id)->get();
        return view('pages.grup.index', [
            'grupRekomendasi'=>$groupRecomData,
            'grupTerbaru'=>$groupNewestData,
            'myGrupData'=>$groupUsersData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.grup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->except(['_token']);

        $data['img_src'] = $request->file('img_src')->store(
            'assets/grup_photo', 'public'
        );
        $data['created_by'] = Auth::user()->id;
        $data['slug'] = Str::slug($request->group_name).rand(1, 999999);

        $group_id = GroupNgaji::insertGetId($data);

        $group['group_ngaji_id'] = $group_id;
        $group['user_id'] = Auth::user()->id;
        $group['joined_at'] = now();
        $group['role_type'] = 'admin';
        
        GroupMember::create($group);

        return redirect()->route('grup.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function detail(Request $request, $slug)
    {
        
        $items = GroupNgaji::where('slug', $slug)->get()->first();
        $anggotaGrup = 
            GroupMember::join('users', 'users.id', 'detail_group_ngajis.user_id')->where('group_ngaji_id', $items->id)->limit('5')->get();
        $isJoined = GroupMember::join('users', 'users.id', 'detail_group_ngajis.user_id')->where('group_ngaji_id', $items->id)->where('users.id', Auth::user()->id)->get();

        $recentActivity = RecitationProgres::where('group_ngaji_id', $items->id)->orderByDesc('created_at')->limit(10)->get();
        $yourRecentActivity = RecitationProgres::where('group_ngaji_id', $items->id)->where('created_by', Auth::user()->id)->orderByDesc('created_at')->limit(3)->get();
        $lastRecitation = RecitationProgres::where('group_ngaji_id', $items->id)->where('created_by', Auth::user()->id)->orderByDesc('created_at')->get()->first();
        return view('pages.grup.detail', [
            'data' =>  $items,
            'listMember' => $anggotaGrup,
            'isJoined' => $isJoined,
            'recentActivity' => $recentActivity,
            'yourRecentActivity' => $yourRecentActivity,
            'lastRecitation' => $lastRecitation
        ]);
    }

    public function listMember(Request $request, $slug){
        $items = GroupNgaji::where('slug', $slug)->get()->first();
        $anggotaGrup = 
            GroupMember::selectRaw('detail_group_ngajis.*, users.first_name, users.last_name')->join('users', 'users.id', 'detail_group_ngajis.user_id')->where('group_ngaji_id', $items->id)->orderBy('role_type')->get();
        return view('pages.grup.list-member', [
            'data' => $items,
            'listMember' => $anggotaGrup
        ]);
    }

    public function join(Request $request, $slug){
        $items = GroupNgaji::where('slug', $slug)->get();
        $group['group_ngaji_id'] = $items[0]->id;
        $group['user_id'] = Auth::user()->id;
        $group['joined_at'] = now();
        $group['role_type'] = 'member';
        
        GroupMember::create($group);

        return redirect()->route('grup.detail', $slug);
    }

    public function setorCreate(Request $request, $slug){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.quran.sutanlab.id/surah');
        $items = GroupNgaji::where('slug', $slug)->get()->first();
        $mentor = User::selectRaw('users.*')->join('detail_group_ngajis', 'detail_group_ngajis.user_id', 'users.id')
                        ->join('group_ngajis', 'group_ngajis.id', 'detail_group_ngajis.group_ngaji_id')
                        ->where('detail_group_ngajis.role_type', 'admin')->where('group_ngajis.slug', $slug)->get();
        
        $lastRecitation = RecitationProgres::where('group_ngaji_id', $items->id)->where('created_by', Auth::user()->id)->where('status', 'Approved')->orderByDesc('created_at')->get()->first();
        $data = json_decode((string) $response->getBody()->getContents(), true);

        return view('pages.grup.setor' , [
            'data' => $items,
            'listQuran' => $data['data'],
            'mentorList' => $mentor,
            'lastRecitation' => $lastRecitation
        ]);
    }

    public function setorStore(Request $request, $slug){
        $items = GroupNgaji::where('slug', $slug)->get();

        $setor['first_surah_id'] = $request->fsurah_id;
        $setor['first_surah'] = $request->first_surah;
        $setor['first_ayat'] = $request->first_ayat;
        $setor['last_surah_id'] = $request->lsurah_id;
        $setor['last_surah'] = $request->last_surah;
        $setor['last_ayat'] = $request->last_ayat;
        $setor['mentor_id'] = $request->mentor_id;
        $setor['created_by'] = Auth::user()->id;
        $setor['status'] = 'Waiting';
        $setor['group_ngaji_id'] = $items[0]->id;


        RecitationProgres::create($setor);

        return redirect()->route('grup.detail', $slug);

    }

    public function inviteMember(Request $request, $slug){

        $user = User::where('email', $request->email)->get()->first();

        $items = GroupNgaji::where('slug', $slug)->get()->first();
        $group['group_ngaji_id'] = $items->id;
        $group['user_id'] = $user->id;
        $group['joined_at'] = now();
        $group['role_type'] = 'member';
        
        GroupMember::create($group);

        return redirect()->route('grup.detail', $slug);

    }


    public function updateRole(Request $request, $slug){

        $member = GroupMember::find($request->id);
        $member->role_type = $request->role_type;

        $member->save();
    

        return "success";

    }

    
}
