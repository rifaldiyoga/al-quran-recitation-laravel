@extends('layouts.app')

@section('title', $data->group_name)

@section('content')
<div class="container mt-100">
    <div class="row">
        <div class="col-md-12">
            <div class="detail-grup">
                <img src="{{ Storage::url($data->img_src) }}" alt=""
                    style="height: 400px; width:100%; object-fit:cover;">
                <div class="single-ayat">
                    <div class="row">
                        <div class="col-md-6">

                            <h3 class="mb-2">{{ $data->group_name }}</h3>
                            <p class="mb-2">{{ Helper::getGroupType($data->group_type) }}</p>
                            <p><i class="fa fa-eye"></i> Grup {{ $data->access_type }},
                                {{ Helper::countMember($data->id) }} Anggota </p>
                        </div>
                        <div class="col-md-6 x-flex y-flex">


                            @if ($isJoined->isEmpty())
                            <form action="{{ route('grup.join', $data->slug) }}" method="post">
                                @csrf
                                <input type="number" name="id" id="id" hidden>
                                <button class="btn btn-info float-right float-bottom" type="submit">Gabung Grup</button>
                            </form>
                            @else
                            @if (Helper::checkRoleInGrup($data->id) != 'admin')
                            <form action="" method="post">
                                @csrf
                                <input type="number" name="id" id="id" hidden>
                                <a href="{{ route('grup.setorCreate', $data->slug) }}"
                                    class="btn btn-info float-right button-rounded float-bottom" type="submit">Setor
                                    Bacaan</a>
                            </form>
                            @endif
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="single-ayat">
                Masih Belum ada Histori
            </div>
            <h5>Aktivitas Terbaru</h5>
            @if (!$recentActivity->isEmpty())
            @foreach ($recentActivity as $item)
            <div class="single-ayat">
                <b>Progress Bacaan</b>
                <p>{{ $item->first_surah }} : {{ $item->first_ayat }} - {{ $item->last_surah }} : {{ $item->last_ayat }}</p>
                <p>{{ Helper::getName($item->created_by) }}</p>

            </div>
            @endforeach

            @else
            <div class="single-ayat">
                Masih Belum ada Histori
            </div>
            @endif

        </div>
        <div class="col">
            <div class="single-ayat">
                <h5 class="mb-4">Anggota Grup</h5>

                @foreach ($listMember as $item)
                <div class="pb-3">
                    <div class="row">
                        <div class="">
                            <img src="{{url('backend/img/undraw_profile.svg')}}" alt="" class="circle"
                                style="height:40px;">

                        </div>
                        <div class="col d-flex border-bottom ml-3 pt-2 pb-2">
                            <p class="mb-2">{{ $item->first_name }} </p>
                            <p class="mb-2 ml-1">{{ $item->role_type == 'admin' ? "(Admin)" : "" }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="row mt-3">
                    <div class="last-read-btn col">
                        <a href="{{ route('grup.listMember', $data->slug) }}" class=""> Lihat Selengkapnya <i
                                class="fa fa-arrow-right ml-2"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
