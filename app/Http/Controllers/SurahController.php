<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurahController extends Controller
{
    //
    public function index(Request $request){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.quran.sutanlab.id/surah');
        
        $data = json_decode((string) $response->getBody()->getContents(), true);
        return view('pages.surah',[
            'items' => $data['data']
        ]);
    }

    public function showDetail($id){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.quran.sutanlab.id/surah/'.$id);
        
        $data = json_decode((string) $response->getBody()->getContents(), true);
        return view('pages.detail-surah',[
            'items' => $data['data']
        ]);
    }
    
}
