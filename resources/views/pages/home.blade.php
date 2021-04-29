@extends('layouts.app')

@section('title', 'Ngaji Yuk!')

@section('content')
<header class="continer">
    <div class="row align-items-center h-100">
        <div class="col-8 mx-auto ">
            <div class="jumbotron float-end">
                <h1>
                    Ngaji Yuk!
                </h1>
                <p>
                    Mari kita tingkatkan kesadaran untuk <br /> membaca Al-Quran
                </p>
            </div>
        </div>
    </div>

</header>

<!-- Pencarian -->

<main>
    <section class=" section-cari container">
        <div class="row justify-content-center text-center m-10">
            <div class="col-6">
                <h1>Pencarian</h1>
                <p>Cari surat atau ayat sesuai keinginanmu</p>
                <form class="form-inline" role="form">
                    <div class="form-group has-success has-feedback">
                        <label class="control-label" for="inputSuccess4"></label>
                        <input type="text" class="form-control px-4 py-3" id="inputSuccess4"
                            placeholder="Contoh 'Al-Khafi'">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                </form>

            </div>
        </div>

    </section>

    <section class="section-rekomendasi">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-8 mx-auto">
                    <h1>
                        Surah Of The Day
                    </h1>
                    <blockquote>
                        {{$rekomendasi['acak']['id']['teks']}}
                    </blockquote>
                    <p>({{ $rekomendasi['surat']['nama'] ." ".$rekomendasi['surat']['ayat']   }}) </p>
                </div>
                <div class="col-4">
                    <img src="frontend/images/doa.png" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="section-grup">
        <div class="container">
            <div class="row">
                <div class="col-3 mx-auto">
                    <h1>Gabung atau Buat
                        Grup Ngaji</h1>
                    <p>Buat grup untuk mempermudah
                        menilai bacaan dengan ustadz/ah
                        ataupun teman-temanmu</p>
                </div>
                <div class="col-9">
                    <div class="container">
                        <div class="row mx-auto">
                            <div class="col-4 box-grup text-center">
                                <img src="frontend/images/contoh.jpg" alt="">
                                <h1>TPQ As-Salam</h1>
                                <p>20 Anggota</p>
                            </div>
                            <div class="col-4 box-grup text-center">
                                <img src="frontend/images/contoh.jpg" alt="">
                                <h1>TPQ As-Salam</h1>
                                <p>20 Anggota</p>
                            </div>
                            <div class="col-4 box-grup text-center">
                                <img src="frontend/images/contoh.jpg" alt="">
                                <h1>TPQ As-Salam</h1>
                                <p>20 Anggota</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
</main>
@endsection
