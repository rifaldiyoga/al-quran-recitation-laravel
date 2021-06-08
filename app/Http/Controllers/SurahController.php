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

        if(Auth::check()){
            $lastReadData = ReadingProgress::where('ref_id', Auth::user()->id)
            ->where('ref_type','user')
            ->orderBy('id', 'desc')
            ->limit(1)->get();
        }
        
        $data = json_decode((string) $response->getBody()->getContents(), true);
        return view('pages.quran.surah',[
            'items' => $data['data'],
            'lastRead'=> Auth::check() && !$lastReadData->isEmpty() ?  $lastReadData[0] : []
        ]);
    }

    public function showDetail($id){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.quran.sutanlab.id/surah/'.$id);
        
        $data = json_decode((string) $response->getBody()->getContents(), true);
        return view('pages.quran.detail-surah',[
            'items' => $data['data']
        ]);
    }

    public function saveLastRead(Request $request){
        if($request->ajax())
        {
            
            $data = array(
                'surah' => $request->surah,
                'surah_id' => $request->surah_id,
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
