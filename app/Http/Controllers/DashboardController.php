<?php

namespace App\Http\Controllers;

use App\ReadingProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function index(Request $request){

        if(Auth::check()){
            $lastReadData = ReadingProgress::where('ref_id', Auth::user()->id)
            ->where('ref_type','user')
            ->orderBy('id', 'desc')
            ->limit(1)->get();
        }

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.banghasan.com/sholat/format/json/jadwal/kota/770/tanggal/'.now()->format('Y-m-d'));
        
        $data = json_decode((string) $response->getBody()->getContents(), true);

        return view('pages.dashboard', [
            'lastRead'=> Auth::check() && !$lastReadData->isEmpty() ?  $lastReadData[0] : [],
            'jadwalSholat' => $data
        ]);
    }
}
