@extends('layouts.app')

@section('title', 'Kemajuan Ngaji')

@section('content')

<div class="container mt-100">
    <div class="row">
        <div class="col-md-12">

            <h5>Riwayat Membaca Al-Quran</h5>
            
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

                    @forelse ($data as $item)
                    <div class="col-md-6">
                        <div class="single-ayat" onclick="location.href='{{ route('surah.detail', $item->surah_id) }}'"
                            style="cursor: pointer">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ url('frontend/images/penanda.png') }}" alt="" style="width: 50px">
                                </div>
                                <div class="col-md-8">
                                    <h5>{{ $item->surah." : ".$item->ayat }}</h5>
                                    <p>Terakhir dibaca {{  $item->created_at->format('d-m-Y')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-md-12">
                        <div class="single-ayat" 
                            style="cursor: pointer">
                            Tidak Ada Riwayat Bacaan
                        </div>
                    </div>
                    @endforelse
                </div>

            

            <h5>Progress Bacaan Pada Grup</h5>
            <div class="row">
            @forelse ($groupList as $item)
                
                    <div class="col-md-3 d-flex">
                        <div class="single-ayat" onclick="location.href='{{ route('kemajuan-belajar.grup', $item->slug) }}'" style="cursor: pointer;">
                            <h5>{{ $item->group_name }}</h5>
                            <i class="fa fa-arrow-right"></i>
                        </div>
                    </div>
                
            @empty
                
            <div class="single-ayat">
                Anda belum masuk kedalam grup
            </div>
            @endforelse
        </div>
        </div>
    </div>
</div>

@endsection
