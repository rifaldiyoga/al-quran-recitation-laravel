<?php

namespace App\Http\Controllers;

use App\ReadingProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\RecitationProgres;
use App\GroupNgaji;

class DashboardController extends Controller
{
    //

    public function index(Request $request){


        $client = new \GuzzleHttp\Client();
        $lastReadData = [];
        $surahResponse = [];
        $dataSurah = [];
        if(Auth::check()){
            $lastReadData = ReadingProgress::where('ref_id', Auth::user()->id)
            ->where('ref_type','user')
            ->orderBy('id', 'desc')
            ->get()->first();

            if(!is_null($lastReadData)){
                $surahResponse = $client->request('GET', 'https://api.quran.sutanlab.id/surah/'.$lastReadData->surah_id);
                $dataSurah = json_decode((string) $surahResponse->getBody()->getContents(), true);
            }
            
        }

        $response = $client->request('GET', 'https://api.pray.zone/v2/times/day.json?city=surabaya&date='.now()->format('Y-m-d'));
        $responseAyat = $client->request('GET', 'https://api.banghasan.com/quran/format/json/acak');
        $groupUsersData = GroupNgaji::selectRaw('group_ngajis.id')->join('detail_group_ngajis', 'detail_group_ngajis.group_ngaji_id', 'group_ngajis.id')->where('detail_group_ngajis.user_id', Auth::user()->id)->get();
        $recentActivity = RecitationProgres::selectRaw('recitation_progres.*, group_ngajis.group_name')->join('group_ngajis', 'group_ngajis.id', 'recitation_progres.group_ngaji_id')->whereIn('group_ngaji_id', $groupUsersData)->orderByDesc('recitation_progres.created_at')->limit(5)->get();
        
        $dataquran = json_decode((string) $responseAyat->getBody()->getContents(), true);        
        $data = json_decode((string) $response->getBody()->getContents(), true);
        return view('pages.dashboard', [
            'lastRead'=> Auth::check() ?  $lastReadData : [],
            'jadwalSholat' => $data,
            'rekomendasi'=>$dataquran,
            'surah'=>!empty($dataSurah) ? $dataSurah['data'] : [],
            'recentActivity' => $recentActivity
        ]);
    }
}
