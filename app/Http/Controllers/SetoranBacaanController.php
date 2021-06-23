<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\RecitationProgresMail;
use App\GroupMember;
use App\RecitationProgres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\GroupNgaji;
use App\User;

class SetoranBacaanController extends Controller
{
    //
    public function index(Request $request){
        
        $query = RecitationProgres::selectRaw('recitation_progres.*, users.first_name, group_ngajis.group_name')
                ->join('users','users.id','recitation_progres.created_by')
                ->join('group_ngajis', 'group_ngajis.id', 'recitation_progres.group_ngaji_id');
                if($request->status != 'All' )
                    $query->where('status', $request->status == null ? 'Waiting' : $request->status);
                
                
        if(!is_null($request->group_id)){
            // echo $request->group_id;
            $member = GroupMember::where('group_ngaji_id', $request->group_id)->where('user_id', Auth::user()->id)->get()->first();

            if($member->role_type == 'admin'){
                $query->where('mentor_id', Auth::user()->id);
            } else {
                $query->where('recitation_progres.created_by', Auth::user()->id);
            }

            $query->where('group_ngajis.id', $request->group_id);
        } else {
            if(Auth::user()->user_type == 1){
                $query->where('mentor_id', Auth::user()->id);
            } else {
                $query->where('recitation_progres.created_by', Auth::user()->id);
            }

        }
        if(!is_null($request->name)){
            $query->where('users.first_name', 'like' ,"%".$request->name."%")->whereOr('users.last_name', 'like', "%".$request->name."%");
        }

                
        $listRecitation  =  $query->orderByDesc('created_at')->get();
        
        $groupUsersData = GroupNgaji::selectRaw('group_ngajis.*')->join('detail_group_ngajis', 'detail_group_ngajis.group_ngaji_id', 'group_ngajis.id')
                ->where('detail_group_ngajis.user_id', Auth::user()->id)->get();
        
        return view('pages.setoran.index', [
            'listRecitaion' => $listRecitation,
            'groupList' => $groupUsersData
        ]);
    }


    public function search(Request $request){
        
        $query = RecitationProgres::selectRaw('recitation_progres.*, users.first_name, group_ngajis.group_name')
                ->join('users','users.id','recitation_progres.created_by')
                ->join('group_ngajis', 'group_ngajis.id', 'recitation_progres.group_ngaji_id');


                if($request->status != 'All')
                    $query->where('status', $request->status);
                

                


        if(!is_null($request->group_id)){
            // echo $request->group_id;
            $member = GroupMember::where('group_ngaji_id', $request->group_id)->where('user_id', Auth::user()->id)->get()->first();
           

            if($member->role_type == 'admin'){
                $query->where('mentor_id', Auth::user()->id);
            } else {
                $query->where('recitation_progres.created_by', Auth::user()->id);
            }

            $query->where('group_ngajis.id', $request->group_id);
        }else {
            if(Auth::user()->user_type == 1){
                $query->where('mentor_id', Auth::user()->id);
            } else {
                $query->where('recitation_progres.created_by', Auth::user()->id);
            }

        }
        if(!is_null($request->name)){
            $query->where('users.first_name', 'like' ,"%".$request->name."%")->whereOr('users.last_name', 'like', "%".$request->name."%");
        }

                
        $listRecitation  =  $query->orderByDesc('created_at')->get();
         
        $groupUsersData = GroupNgaji::selectRaw('group_ngajis.*')->join('detail_group_ngajis', 'detail_group_ngajis.group_ngaji_id', 'group_ngajis.id')
                ->where('detail_group_ngajis.user_id', Auth::user()->id)->get();
    
        return view('pages.setoran.index', [
            'listRecitaion' => $listRecitation,
            'groupList' => $groupUsersData
        ], );
    }

    public function updateStatus(Request $request){

        $progress = RecitationProgres::find($request->id);
        $progress->status = $request->status;
        
        $progress->save();

        $santri = User::where('id', $progress->created_by)->first();

        //kirim email



        Mail::to($santri->email)->send(
            new RecitationProgresMail($progress, $santri)
        );

        return 'success';
    }
}
