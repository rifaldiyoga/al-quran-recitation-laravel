@extends('layouts.app')

@section('title', 'Ngaji Yuk!')

@section('content')
<main class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h1>{{ $items['name']['transliteration']['id'] . "(".$items['name']['short'].")" }}</h1>
                
                    @foreach ($items['verses'] as $data)
                    <div class="card p-3 mb-3">

                        <p class="text-right float-right" style="text-align: right; font-size : 20px">{{ $data['text']['arab']." ".$data['number']['inSurah'] }}</p>
                        <br>
                        <b class="mb-3">{{ $data['text']['transliteration']['en'] }}</b>
                        <br>
                        <p class="mb-3">{{ $data['translation']['id'] }}</p>
                        <p class="mb-3">Tafsir : <br>{{ $data['tafsir']['id']['short'] }}</p>
                         <audio controls>
                            <source src="{{ $data['audio']['primary'] }}" type="audio/mpeg" style="max-width: 200px"> 
                        </audio>
                    </div>
                    @endforeach

        </div>
    </div>
</main>
@endsection
