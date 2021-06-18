@extends('layouts.app')

@section('title', 'Grup Ngaji')

@section('content')
<div class="container mt-100">
    <div class="row">
        <div class="col">
            <h3>Anggota Grup</h3>
            <div class="single-ayat">
                @foreach ($listMember as $item)
                    <div class="pb-3">
                        <div class="row">
                            <div class="p-3">
                                <img src="{{url('backend/img/undraw_profile.svg')}}" alt="" class="circle" style="height:60px;"> 
                                
                            </div>
                            <div class="col mx-auto border-bottom p-3 align-self-center" >
                                <p class="mt-2 mb-3" style="font-size: 22px">{{ $item->first_name }} {{ $item->last_name }}</p>
                                <p class="badge badge-pill badge-info p-2" style="">{{ $item->role_type == 'admin' ? "Admin" : "" }}</p>  
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script text="application/javascript">


</script>
@endsection
