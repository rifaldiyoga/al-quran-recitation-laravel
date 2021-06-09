<?php

namespace App\Http\Controllers;

use App\GroupNgaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(Request $request){

        if(Auth::check())
            return redirect('dashboard');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.banghasan.com/quran/format/json/acak');
        
        $data = json_decode((string) $response->getBody()->getContents(), true);

        $groupData = GroupNgaji::limit(3)->get();
        return view('pages.home', [
            'rekomendasi'=>$data,
            'grup'=>$groupData
        ]);
    }
}
