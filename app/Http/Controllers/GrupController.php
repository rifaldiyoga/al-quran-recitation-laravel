<?php

namespace App\Http\Controllers;

use App\GroupMember;
use Illuminate\Http\Request;
use App\GroupNgaji;
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
        $groupUsersData = GroupNgaji::where('created_by', Auth::user()->id)->get();
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
        
        $items = GroupNgaji::where('slug', $slug)->get();

        return view('pages.grup.detail', [
            'data' => !$items->isEmpty() ? $items[0]: []
        ]);
    }

    
}
