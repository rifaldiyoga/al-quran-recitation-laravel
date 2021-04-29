<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(Request $request){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.banghasan.com/quran/format/json/acak');
        
        $data = json_decode((string) $response->getBody()->getContents(), true);
        return view('pages.home', [
            'rekomendasi'=>$data
        ]);
    }
}
