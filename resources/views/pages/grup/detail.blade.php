@extends('layouts.app')

@section('title', $data->group_name)

@section('content')
<div class="container mt-100">
    <div class="row">
        <div class="col-md-12">
            <div class="detail-grup">
                <img src="{{ Storage::url($data->img_src) }}" alt=""
                    style="height: 400px; width:100%; object-fit:cover;">
                <div class="single-ayat" style="top: -10">
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
                            @if (Helper::checkRoleInGrup($data->id, Auth::user()->id) != 'admin')
                            <form action="" method="post">
                                @csrf
                                <input type="number" name="id" id="id" hidden>
                                @if (!empty($lastRecitation) && $lastRecitation->status == 'Waiting')
                                <a href="#" data-toggle="modal" data-target="#infoModal"
                                    class="btn btn-secondary float-right button-rounded float-bottom" type="submit"
                                    style="color: white;">Setor
                                    Bacaan</a>
                                @else
                                <a href="{{ route('grup.setorCreate', $data->slug) }}"
                                    class="btn btn-info float-right button-rounded float-bottom" type="submit"
                                    style="color: white;">Setor
                                    Bacaan</a>
                                @endif
                            </form>
                            @else
                            <a href="#" data-toggle="modal" data-target="#inviteModal"
                                class="btn btn-info float-right button-rounded float-bottom" type="submit"
                                style="color: white;">Undang Ke Grup</a>
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

            <h5>Aktivitas Terkini</h5>
            @if (!$recentActivity->isEmpty())
            @foreach ($recentActivity as $item)
            <div class="single-ayat">
                <div class="row d-flex post-title">
                    <img class="my-auto" src="{{url('backend/img/undraw_profile.svg')}}" alt="" class="circle"
                        style="height:50px;">

                    <div class="ml-3 col">
                        <p class="title">{{ Helper::getName($item->created_by) }}
                            {{-- <p class="subtitle text-capitalize">{{ Helper::checkRoleInGrup($data->id, $item->created_by) }}
                        </p> --}}
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
        <div class="col">
            @if (!$isJoined->isEmpty() && Helper::checkRoleInGrup($data->id, Auth::user()->id) == 'admin')
            <div class="single-ayat">
                Beberapa setoran bacaan belum di nilai!
                <div class="row mt-3">
                    <div class="last-read-btn col">
                        <a href="{{ route('setoran.search').'?group_id='.$data->id.'&status=Waiting' }}" class=""> Nilai
                            Sekarang <i class="fa fa-arrow-right ml-2"></i></a>
                    </div>
                </div>
            </div>
            @endif

            @if (!$isJoined->isEmpty() && Helper::checkRoleInGrup($data->id, Auth::user()->id) == 'member')
            <div class="single-ayat">
                <h5>Riwayat Bacaan Kamu</h5>
                
                @foreach ($yourRecentActivity as $item)
                <?php 

                    $status = 'badge-info';
                    if($item->status == 'Approved'){
                        $status = 'badge-success';
                    }
                    if($item->status == 'Rejected'){
                        $status = 'badge-danger';
                    }
                    ?>
                <div class="pt-3 pb-3">
                    <p class="">
                        {{ $item->first_surah }} : {{ $item->first_ayat }} - {{ $item->last_surah }} :
                        {{ $item->last_ayat }}</p>
                    <p class="badge badge-pill {{ $status }}">{{ $item->status }}</p>
                </div>
                @endforeach
                <div class="row mt-3">
                    <div class="last-read-btn col">
                        <a href="{{ route('setoran.search').'?group_id='.$data->id.'&status=Waiting' }}" class=""> Lihat Selengkapnya <i class="fa fa-arrow-right ml-2"></i></a>
                    </div>
                </div>
            </div>
            @endif

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
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tidak bisa setor bacaan dikarenakan bacaan sebelumnya belum di setujui
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="inviteModal" tabindex="-1" role="dialog" aria-labelledby="inviteModalLabel"
    aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inviteModalLabel">Undang Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('grup.inviteMember', $data->slug) }}" method="post">
                @csrf
                <div class="modal-body">
                    <label for="email">Masukkan Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" type="submit">Oke</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
