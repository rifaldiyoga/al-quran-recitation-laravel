@extends('layouts.app')

@section('title', 'Surah')

@section('content')
<main class="container-fluid mt-100" >
    
    <div class="row">
        <div class="col-md-9">
            
        </div>
        <div class="col-md-3">
            
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-9">
            @auth
            <div class="last-read">
                <div class="row">
                    <div class="col-md-8">
                        <h3>Quran Completion</h3>
                        <h6 class="mt-10">{{ empty($lastRead) ? "Start Your Read" :  "Last Read ". $lastRead->surah." ".$lastRead->ayat }} </h6>
                        <div class="w3-light-gray w3-round-xlarge mt-15">
                            <div class="w3-white w3-round-xlarge " style="height:24px;width:75%"></div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="last-read-btn mb-10" style="bottom: 0px; position: absolute;">
                            <a href="{{ route('surah.detail', empty($lastRead) ? '1' : $lastRead->surah_id) }}">Lanjutkan ></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <img class="quran-img" src="{{ url('frontend/images/quran.png') }}" class="">
                    </div>
                </div>
                
            </div>
            @endauth
            <h3 class="ml-30 mt-30">Daftar Surat</h3>
            <div class="row">
                @foreach ($items as $data)
                <div class="col-lg-4">
                    <div class="single-surah" onclick="location.href='{{ route('surah.detail', $data['number']) }}'" style="cursor: pointer">
                        <div class="row">
                            <div class="col-md-3 aligin-items-center surah-author">
                                <div class="author-image">

                                    <img class="shape" src="frontend/images/textimonial-shape.svg" alt="shape">
                                    <p class="author mt-3 ml-2">{{ $data['number'] }}</p>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <h6 class="holder-name"><a href="{{ route('surah.detail', $data['number']) }}">{{ $data['name']['transliteration']['id']}}</a></h6>
                                <p class="text">{{ $data['name']['translation']['id']}}</p>
                                    
                            </div>
                            <div class="col-md-4">
                                <p class="ayat-quran surah-title text-right">{{  $data['name']['short'] }}</p>
                            </div>
                        </div>
                       
                    </div>
                    </a> <!-- single surah -->
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-3">
            <div class="subscribe-form">
                <form action="#">
                    <input type="text" placeholder="Contoh 'Al - Khafi'">
                    <button class="main-btn">Cari</button>
                </form>
            </div>
                <div class="single-surah">
                    <div class="surah-review d-flex align-items-center justify-content-between">
                        <div class="quota">
                            <i class="lni-quotation"></i>
                        </div>
                        
                    </div>
                    <div class="surah-text">
                        <p class="text">asdassdasdasd</p>
                    </div>
                    <div class="surah-author d-flex align-items-center">
                        <div class="author-image">
                            <img class="shape" src="frontend/images/textimonial-shape.svg" alt="shape">
                            <img class="author" src="" alt="author">
                        </div>
                        <div class="author-content media-body">
                            <h6 class="holder-name">adsasd</h6>
                            <p class="text">CEO, SpaceX</p>
                        </div>
                    </div>
                </div> <!-- single surah -->
            
        </div>
    </div>
</main>
@endsection
