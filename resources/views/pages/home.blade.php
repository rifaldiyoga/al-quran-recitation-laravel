@extends('layouts.app')

@section('content')

@section('title', 'Home')

@section('header')
    
@endsection

<!--====== SERVICES PART START ======-->

<header class="header-area">
    <div id="home" class="header-hero bg_cover" style="background-image: url({{ url('frontend/images/banner-bg.svg') }})">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="header-hero-content text-center">
                        <h3 class="header-title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.2s">Ngaji Yuk!</h3>
                        <h2 class="header-sub-title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.5s"> Mari kita tingkatkan kesadaran untuk membaca Al-Quran</h2>
                        @guest
                            
                        <a href="{{ url('register') }}" class="main-btn wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="1.1s">Daftar</a>
                        @endguest
                    </div> <!-- header hero content -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-hero-image text-center wow fadeInUp" data-wow-duration="0.7s" data-wow-delay="1s">
                        <img src="frontend/images/img_baner.png" alt="hero" style="box-shadow: 20px;">
                    </div> <!-- header hero image -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
        <div id="particles-1" class="particles"></div>
    </div> <!-- header hero -->
</header>

<section id="features" class="services-area pt-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-title text-center pb-40">
                    <div class="line m-auto"></div>
                    <h3 class="title">Cari Ayat Al-Quran <span> Dengan Cepat dan Mudah!</span></h3>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
        <div class="row justify-content-center">
            
            <div class="col-md-9">
                <div class="subscribe-form mt-30">
                    <form action="#">
                        <input type="text" placeholder="Contoh 'Al - Khafi'">
                        <button class="main-btn">Cari</button>
                    </form>
                </div>
            </div> <!-- row -->
         <!-- subscribe area -->
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== SERVICES PART ENDS ======-->

<!--====== ABOUT PART START ======-->

<section class="about-area pt-70">
    <div class="about-shape-2">
        <img src="frontend/images/about-shape-2.svg" alt="shape">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 order-lg-last">
                <div class="about-content mt-50 wow fadeInLeftBig" data-wow-duration="0.5s" data-wow-delay="0.5s">
                    <div class="section-title">
                        <div class="line"></div>
                        <h3 class="title">Quote <span> Hari Ini</span></h3>
                    </div> <!-- section title -->
                    
                    <p class="text"> <i class="lni-quotation"></i> {{$rekomendasi['acak']['id']['teks']}}</p>
                    <p class="text">({{ $rekomendasi['surat']['nama'] ." : ".$rekomendasi['surat']['ayat']   }}) </p>
                </div> <!-- about content -->
            </div>
            <div class="col-lg-6 order-lg-first">
                <div class="about-image text-center mt-50 wow fadeInRightBig" data-wow-duration="1s" data-wow-delay="0.5s">
                    <img src="frontend/images/img_ngaji.png" alt="about">
                </div> <!-- about image -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== TESTIMONIAL PART START ======-->

<section id="testimonial" class="testimonial-area pt-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="section-title text-center pb-40">
                    <div class="line m-auto"></div>
                    <h3 class="title">Gabung Grup Ngaji
                        <span> Disekitarmu</span></h3>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
        <div class="row wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.8s">
            @foreach ($grup as $item)
            <div class="col-lg-4 d-flex">
                <div class="single-testimonial">
                    <div class="testimonial-review d-flex align-items-center justify-content-between">
                        <div class="quota">
                            <i class="lni-quotation"></i>
                        </div>
                        
                    </div>
                    <div class="testimonial-text">
                        <p class="text">{{ $item->group_desc }}</p>
                    </div>
                    <div class="testimonial-author d-flex align-items-center">
                        <div class="author-image">
                            <img class="shape" src="frontend/images/textimonial-shape.svg" alt="shape">
                            <img class="author" src="{{ Storage::url($item->img_src) }}" alt="author">
                        </div>
                        <div class="author-content media-body">
                            <h6 class="holder-name">{{ $item->group_name }}</h6>
                            <p class="text">{{ Helper::countMember($item->id) }} Anggota</p>
                        </div>
                    </div>
                </div> <!-- single testimonial -->
            </div>
            @endforeach
       
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== TESTIMONIAL PART ENDS ======-->


<!--
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-lg-"></div>
        </div>
    </div>
</section>
-->

<!--====== PART ENDS ======-->

@endsection