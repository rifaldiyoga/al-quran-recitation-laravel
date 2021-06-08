@extends('layouts.app')

@section('title', 'Grup Ngaji')

@section('content')
    <div class="container-fluid mt-100">
        <div class="row">
            <div class="col-md-2">
                <div class="single-ayat">
                    <h5 class="mb-3">Grup Yang Saya Ikuti</h5>
                    @foreach ($myGrupData as $item)
                        <div class="row p-2">
                            <a href="{{ route('grup.detail', $item->slug) }}">{{ $item->group_name }}</a>
                        </div>
                    @endforeach
                    <hr>
                    <a href="{{ route('grup.create') }}" class="last-read-btn" style="width: 100%"><i class="fa fa-plus text-left"></i> Buat Grup</a>
                    

                </div>
            </div>
            <div class="col-md-8">
                <div class="single-ayat">
                    <h5>Saran Grup</h5>
                    <section id="testimonial" class="testimonial-area">
                        <div class="container">
                            <div class="row wow " data-wow-duration="1s" data-wow-delay="0.8s">
                                @foreach ($grupRekomendasi as $item)
                                <div class="col-lg-4">
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
                                                <p class="text">CEO, SpaceX</p>
                                            </div>
                                        </div>
                                    </div> <!-- single testimonial -->
                                </div>
                                @endforeach
                           
                            </div> <!-- row -->
                        </div> <!-- container -->
                    </section>

                </div>
            </div>
        </div>
    </div>
@endsection