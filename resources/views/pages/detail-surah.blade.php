@extends('layouts.app')

@section('title', 'Ngaji Yuk!')

@section('content')
<main class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h1>{{ $items['name']['transliteration']['id'] . "(".$items['name']['short'].")" }}</h1>
                
                    @foreach ($items['verses'] as $data)
                    <div class="card p-3 mb-3">

                        <p class="text-right">{{ $data['text']['arab']." ".$data['number']['inSurah'] }}</p>
                        <br>
                        <b>{{ $data['text']['transliteration']['en'] }}</b>
                        <br>
                        {{ $data['translation']['id'] }}
                         <audio controls>
                            <source src="{{ $data['audio']['primary'] }}" type="audio/mpeg"> 
                        </audio>
                    </div>
                    @endforeach

        </div>
    </div>
</main>
@endsection
