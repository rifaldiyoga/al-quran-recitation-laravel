<?php

namespace App\Http\Controllers;

use App\GroupMember;
use Illuminate\Http\Request;
use App\GroupNgaji;

class DetailGrupController extends Controller
{
    //
    public function index(Request $request, $slug)
    {
        
        $items = GroupNgaji::where('slug', $slug)->get();
        $anggotaGrup = GroupMember::join('user', 'user.id = detail_group_ngajis.user_id')->where('group_ngaji_id', $items->id)->limit('5')->get();

        var_dump($anggotaGrup);
        die();
        return view('pages.grup.detail', [
            'data' => $items,
            'listMember' => $anggotaGrup
        ]);
    }

}
