@extends('layouts.admin')

@section('title', 'Group Ngaji - Create')

@show

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Group Ngaji</h1>
        <a href="{{route('group-ngaji.create')}}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fa-plus fa-sm text-white-50"></i> Tambah Grup Ngaji
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item)
                    <li> {{ $errors }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('group-ngaji.store') }}" method="POST" enctype="multipart/form-data"> 
                @csrf
                <div class="form-group">
                    <label for="group_name">Nama Group</label>
                    <input type="text" class="form-control" name="group_name" placeholder="Nama Grup" value="{{ old('group_name') }}"/>
                </div>

                
                <div class="form-group">
                    <label for="group_type">Tipe Grup</label>
                    <input type="text" class="form-control" name="group_type" placeholder="Nama Grup" value="{{ old('group_type') }}"/>
                </div>

                <div class="form-group">
                    <label for="access_type">Tipe Akses Grup</label>
                    <input type="text" class="form-control" name="access_type" placeholder="Nama Grup" value="{{ old('access_type') }}"/>
                </div>

                <div class="form-group">
                    <label for="img_src">Logo Grup</label>
                    <input type="file" class="form-control" name="img_src" placeholder="Nama Grup"/>
                </div>

                <div class="form-group">
                    <label for="group_name">Deskripsi Group</label>
                    <textarea name="group_desc" cols="30" rows="10" class="d-block w-100 form-control">{{ old('group_desc') }}</textarea>
                </div>


            
                <button class="btn btn-submit btn-block" type="submit">
                    Simpan
                </button>

            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
