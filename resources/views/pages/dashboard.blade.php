@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid mt-100">
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
            <div class="single-ayat">
                
            </div>
        </div>
        <div class="col-md-3">
            <div class="single-ayat">
                <h5 class="text-center mb-3">Jadwal Yang Akan Datang </h5>
                <hr>
                <a href="{{ route('grup.create') }}" class="last-read-btn" style="width: 100%"><i
                        class="fa fa-plus text-left"></i> Buat Grup</a>
            </div>
            
            <div class="single-ayat">
                <h5 class="text-center mb-3">Jadwal Sholat di Surabaya</h5>
                <?php 
                    $sholat = ['Imsak', 'Fajr', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'];
                ?>
                <div class="container">
                    @foreach ($sholat as $item)
                    <div class="row text-center p-2 border-bottom">
                        <div class="col">
                            <p> {{ ucfirst($item) }} </p> 
                        </div>
                        <div class="col">
                            <?php ?>
                            <p> {{ $jadwalSholat['results']['datetime'][0]['times'][$item] }} </p> 
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection