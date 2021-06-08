@extends('layouts.app')

@section('title', 'Grup Ngaji')

@section('content')
<div class="container-fluid mt-100">
    <div class="row">
        <div class="col">
            <div class="single-ayat">
                <h5 class="mb-3">Grup Yang Saya Ikuti</h5>
                @if ($myGrupData->isEmpty())
                <div class="row p-2">
                    <div class="col">

                        <b class="text-center" style="width: 100%">Soleh bareng-bareng yuk!</b>
                        <p class="">Buat grup ngaji bareng temanmu</p>
                    </div>
                </div>
                @else
                    @foreach ($myGrupData as $item)
                    <div class="row p-2">
                        <a href="{{ route('grup.detail', $item->slug) }}">{{ $item->group_name }}</a>
                    </div>
                    @endforeach
                @endif

                <hr>
                <a href="{{ route('grup.create') }}" class="last-read-btn" style="width: 100%"><i
                        class="fa fa-plus text-left"></i> Buat Grup</a>


            </div>
        </div>
        <div class="col-md-7">
            <div class="single-ayat">
                <div class="row">
                    <div class="col">

                        <h3>Saran Grup</h3>
                        <div class="row " data-wow-duration="1s" data-wow-delay="0.8s">
                            @foreach ($grupRekomendasi as $item)
                            <div class="col-md-4" onclick="location.href='{{ route('grup.detail', $item->slug) }}'">
                                <div class="single-grup text-center mt-30 wow fadeIn" data-wow-duration="1s"
                                    data-wow-delay="0.2s"
                                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeIn;">
                                    <div class="grup-image">
                                        <img src="{{ Storage::url($item->img_src) }}" alt="Team">
    
                                    </div>
                                    <div class="grup-content">
                                        <h5 class="holder-name"><a href="{{ route('grup.detail', $item->slug) }}">{{ $item->group_name }}</a></h5>
                                        <p class="text">20 Anggota</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
    
    
                        </div> <!-- row -->
                    </div>
                </div>

                <div class="row mt-50">
                    <div class="col-md-12">

                        <h3>Grup Terbaru</h3>
                        <div class="row" data-wow-duration="1s" data-wow-delay="0.8s">
                            @foreach ($grupTerbaru as $item)
                            <div class="col-3" onclick="location.href='{{ route('grup.detail', $item->slug) }}'">
                                <div class="single-grup text-center mt-30 wow fadeIn" data-wow-duration="1s"
                                    data-wow-delay="0.2s"
                                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeIn;">
                                    <div class="grup-image">
                                        <img src="{{ Storage::url($item->img_src) }}" alt="Team">
    
                                    </div>
                                    <div class="grup-content">
                                        <h5 class="holder-name"><a href="{{ route('grup.detail', $item->slug) }}">{{ $item->group_name }}</a></h5>
                                        <p class="text">20 Anggota</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div> <!-- row -->
                    </div>
                </div>

            </div>
        </div>
        <div class="col">
            <div class="subscribe-form">
                <form action="#">
                    <input type="text" placeholder="Contoh Grup">
                    <button class="main-btn">Cari</button>
                </form>
            </div>

            <div class="single-ayat">
                <h5 class="mb-3">Jadwal Yang Akan Datang</h5>
                @foreach ($myGrupData as $item)
                <div class="row p-2">
                    <a href="{{ route('grup.detail', $item->slug) }}">{{ $item->group_name }}</a>
                </div>
                @endforeach
                <hr>
                <a href="{{ route('grup.create') }}" class="last-read-btn" style="width: 100%"><i
                        class="fa fa-plus text-left"></i> Buat Grup</a>


            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script text="application/javascript">


</script>
@endsection
