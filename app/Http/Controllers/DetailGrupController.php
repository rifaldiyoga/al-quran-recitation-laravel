<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupNgaji;

class DetailGrupController extends Controller
{
    //
    public function index(Request $request, $slug)
    {
        
        $items = GroupNgaji::where('slug', $slug)->get();

        return view('pages.grup.detail', [
            'data' => $items
        ]);
    }

}
