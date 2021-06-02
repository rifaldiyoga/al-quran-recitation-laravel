@extends('layouts.app')


@section('content')
    <div class="container mt-100">
        <div class="row">
            <div class="col-md-12">
                <div class="detail-grup">
                        <img src="{{ Storage::url($data->img_src) }}" alt="" style="height: 400px; width:100%; object-fit:cover;" >
                    <div class="single-ayat">
                        <h3>{{ $data->group_name }}</h3>
                        <p>{{ $data->group_type }}</p>
                        <p><i class="fa fa-eye"></i> Grup {{ $data->access_type }}, 20 Anggota   </p>
                    </div> 
                </div>
                
            </div>
           
        </div>
    </div>
@endsection