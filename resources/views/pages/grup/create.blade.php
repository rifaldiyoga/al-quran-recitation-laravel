@extends('layouts.app')

@section('title', 'Buat Grup Baru')

@section('content')
    <div class="container mt-100" >
         <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buat Grup Ngaji</h1>
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

    <div class="single-ayat shadow">
        <div class="card-body">
            <form action="{{ route('grup.store') }}" method="POST" enctype="multipart/form-data"> 
                @csrf
                <div class="form-group">
                    <label for="group_name">Nama Grup Ngaji</label>
                    <input type="text" class="form-control" name="group_name" placeholder="Nama Grup" value="{{ old('group_name') }}"/>
                </div>

                
                <div class="form-group">
                    <label for="group_type">Tipe Grup</label>
                    <select name="group_type" id="group_type" class="form-control">
                        <option value="1">Grup Ngaji Bareng</option>
                        @if (Auth::user()->user_type == '1')
                            <option value="2">Grup Ngaji Bareng Ustadz</option>
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="access_type">Tipe Akses Grup</label>
                    <select name="access_type" id="access_type" class="form-control">
                        <option value="Public"><i class="fa fa-public"></i> Public</option>
                        <option value="Private"><i class="fa fa-lock"></i>Private</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="img_src">Logo Grup</label>
                    <input type="file" class="form-control" name="img_src" placeholder="Nama Grup"/>
                </div>

                <div class="form-group">
                    <label for="group_name">Deskripsi Group</label>
                    <textarea name="group_desc" cols="30" rows="10" class="d-block w-100 form-control">{{ old('group_desc') }}</textarea>
                </div>


            
                <button class="btn main-btn btn-block" type="submit">
                    Simpan
                </button>

            </form>
        </div>
    </div>
    </div>
@endsection