<?php

namespace App\Http\Controllers;

use App\ReadingProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class KemajuanBelajarController extends Controller
{
    //

    function index(Request $request) {

        $data = ReadingProgress::where('ref_id', Auth::user()->id)->where('ref_type', 'user')->orderByDesc('created_at')->get();
        return view('pages.kemajuan-belajar', [
            'data' => $data
        ]);
    }
}
