@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container mt-100">
    <div class="row">
        <div class="col-md-12">
            @auth
            <div class="last-read">
                <div class="row">
                    <div class="col-md-8">
                        <h3>Quran Completion</h3>
                        <h6 class="mt-10">
                            {{ empty($lastRead) ? "Start Your Read" :  "Last Read ". $lastRead->surah." ".$lastRead->ayat }}
                        </h6>
                        @if (!empty($lastRead))
                        <div class="w3-light-gray w3-round-xlarge mt-15">
                            <?php 
                                
                                $new_width = ($lastRead->ayat / $surah['numberOfVerses']) * 100;
                                ?>
                            <div class="w3-white w3-round-xlarge " style="height:24px;width:{{ $new_width }}%"></div>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-1">
                        <div class="last-read-btn mb-10" style="bottom: 0px; position: absolute;">
                            <a href="{{ route('surah.detail', empty($lastRead) ? '1' : $lastRead->surah_id) }}">Lanjutkan
                                ></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <img class="quran-img" src="{{ url('frontend/images/quran.png') }}" class="">
                    </div>
                </div>

            </div>
            @endauth
            <div class="row">

                <div class="col-md-12">
                    <div class="single-ayat w-100">
                        <h5 class="text-center mb-10">Jadwal Sholat di Surabaya</h5>
                        <?php 
                            $sholat = ['Imsak', 'Fajr', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'];
                        ?>
                        <div class="row d-flex">
                            @foreach ($sholat as $item)
                            <div class="col-md-2 text-center {{ $loop->last ? '' : 'border-right' }}">
                                <b> {{ ucfirst($item) }} </b>
                                <p> {{ $jadwalSholat['results']['datetime'][0]['times'][$item] }} </p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h5>Aktivitas Terkini</h5>
                    @if (!$recentActivity->isEmpty())
                    @foreach ($recentActivity as $item)
                    <div class="single-ayat">
                        <div class="row d-flex post-title">
                            <img class="my-auto" src="{{url('backend/img/undraw_profile.svg')}}" alt="" class="circle"
                                style="height:50px;">

                            <div class="ml-3 col">
                                <p class="title">{{ Helper::getName($item->created_by) }} pada {{ $item->group_name }}
                                </p>
                                <p class="subtitle">{{ $item->created_at->diffForHumans() }}</p>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col p-3">
                                <b>Progress Bacaan Terakhir</b>
                                <p>{{ $item->first_surah }} : {{ $item->first_ayat }} - {{ $item->last_surah }} :
                                    {{ $item->last_ayat }}</p>

                            </div>


                        </div>

                    </div>
                    @endforeach

                    @else
                    <div class="single-ayat">
                        Masih Belum ada Histori
                    </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="single-ayat">
                        <div class="row">
                            <div class="col">
                                <h5 class="mb-10">Rekomendasi Ayat Al-Quran</h5>
                            </div>
                        </div>
                        <div class="testimonial-review d-flex align-items-center justify-content-between">
                            <div class="quota pb-20">
                                <i class="lni-quotation"></i>
                                <p class="text"> {{ucfirst($rekomendasi['acak']['id']['teks'])}}</p>
                                <b class="text">({{ $rekomendasi['surat']['nama'] ." : ".$rekomendasi['surat']['ayat']   }})
                                </b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
