<?php

namespace App\Http\Controllers;

use App\ReadingProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\GroupNgaji;
use App\RecitationProgres;

class KemajuanBelajarController extends Controller
{
    //

    function index(Request $request) {

        $data = ReadingProgress::where('ref_id', Auth::user()->id)->where('ref_type', 'user')->orderByDesc('created_at')->get();
        $groupUsersData = GroupNgaji::join('detail_group_ngajis', 'detail_group_ngajis.group_ngaji_id', 'group_ngajis.id')
                ->where('detail_group_ngajis.user_id', Auth::user()->id)->get();
        
        return view('pages.progres.kemajuan-belajar', [
            'data' => $data,
            'groupList' => $groupUsersData
        ]);
    }

    function progresGrup(Request $request, $slug){
        $grup = GroupNgaji::where('slug', $slug)->first();
        $listRecitation = RecitationProgres::selectRaw('recitation_progres.*, users.first_name, group_ngajis.group_name')
                ->join('users','users.id','recitation_progres.created_by')
                ->join('group_ngajis', 'group_ngajis.id', 'recitation_progres.group_ngaji_id')
                ->where('recitation_progres.created_by', Auth::user()->id)->where('group_ngaji_id', $grup->id)->orderByDesc('created_at')->get();
        
        return view('pages.progres.grup-kemajuan-belajar', [
            'listRecitaion' => $listRecitation,
            'grup' => $grup
        ]);
    }
}
