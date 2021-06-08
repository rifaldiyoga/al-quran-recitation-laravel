@extends('layouts.app')

@section('title', 'Kemajuan Ngaji')

@section('content')

<div class="container mt-100">
    <div class="row">
        <div class="col-md-12">
            
            <h3>Riwayat Membaca Al-Quran</h3>
            <div class="single-ayat">
                <div class="row">
                    
                    <?php
                        function getTimeAgo($date){
                            if(now()->diffInDays($date) != 0){
                                return now()->diffInDays($date) . " Hari Lalu";
                            }
                            if(now()->diffInHours($date) != 0){
                                return now()->diffInHours($date) . " Jam Lalu";
                            }
                            if(now()->diffInMinutes($date) != 0){
                                return now()->diffInMinutes($date) . " Menit Lalu";
                            }
                        }    
                    ?>

                    @foreach ($data as $item)
                        <div class="col-md-6">
                            <div class="single-ayat" onclick="location.href='{{ route('surah.detail', $item->surah_id) }}'" style="cursor: pointer">
                                <div class="row">
                                    <div class="col-md-2" >
                                        <img src="{{ url('frontend/images/penanda.png') }}" alt="" style="width: 50px">
                                    </div>
                                    <div class="col-md-8">
                                        <h5>{{ $item->surah." : ".$item->ayat }}</h5>
                                        <p>Terakhir dibaca {{  getTimeAgo($item->created_at)}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
    
            </div>
        </div>
    </div>
</div>
    
@endsection