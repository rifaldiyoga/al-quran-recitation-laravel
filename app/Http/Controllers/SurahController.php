<?php

namespace App\Http\Controllers;

use App\ReadingProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class SurahController extends Controller
{
    //
    public function index(Request $request){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.quran.sutanlab.id/surah');
        
        $lastReadData = [];
        $surahResponse = [];
        $dataSurah = [];
        if(Auth::check()){
            $lastReadData = ReadingProgress::where('ref_id', Auth::user()->id)
            ->where('ref_type','user')
            ->orderBy('id', 'desc')
            ->limit(1)->get()->first();

            if(!is_null($lastReadData)){
                $surahResponse = $client->request('GET', 'https://api.quran.sutanlab.id/surah/'.$lastReadData->surah_id);
                $dataSurah = json_decode((string) $surahResponse->getBody()->getContents(), true);
            }
            
        }
        
        $data = json_decode((string) $response->getBody()->getContents(), true);
        
        return view('pages.quran.surah',[
            'items' => $data['data'],
            'surah' => !empty($dataSurah) ? $dataSurah['data'] : [],
            'lastRead'=> Auth::check() ?  $lastReadData : []
        ]);
    }

    public function showDetail($id){
        $client = new \GuzzleHttp\Client();
        $responseSurah = $client->request('GET', 'https://api.quran.sutanlab.id/surah/'.$id);
        $responseListSurah = $client->request('GET', 'https://api.quran.sutanlab.id/surah');
        
        $dataSurah = json_decode((string) $responseSurah->getBody()->getContents(), true);
        $dataListSurah = json_decode((string) $responseListSurah->getBody()->getContents(), true);
        return view('pages.quran.detail-surah',[
            'items' => $dataSurah['data'],
            'listSurah' => $dataListSurah['data']
        ]);
    }

    public function saveLastRead(Request $request){
        if($request->ajax()){
            $data = array(
                'surah' => $request->surah,
                'surah_id' => $request->surah_id,
                'group_id' => 0,
                'ayat' => $request->ayat,
                'ref_type' => 'user',
                'ref_id' => Auth::user()->id,
            );

            ReadingProgress::create($data);
            return response()->json([
                'success'  => 'Data Added successfully.'
            ]);
        
        }

    }
    
}
