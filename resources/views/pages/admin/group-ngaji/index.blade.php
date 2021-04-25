@extends('layouts.admin')

@section('title', 'Group Ngaji')

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


    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nama Grup</td>
                            {{-- <td>Grup Desc</td> --}}
                            <td>Created By</td>
                            <td>Tipe Grup</td>
                            <td>Tipe Akses Grup</td>
                            <td>Gambar</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->group_name }}</td>
                            {{-- <td>{{ $items->group_desc}}</td> --}}
                            <td>{{ $item->created_by }}</td>
                            <td>{{ $item->group_type}}</td>
                            <td>{{ $item->access_type}}</td>
                            <td>
                                <img src="{{ Storage::url($item->img_src) }}" alt="" style="max-width: 200px">
                            </td>
                            <td>
                                <a href="{{ route('group-ngaji.edit', $item->id)}}" class="btn btn-info">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('group-ngaji.destroy', $item->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr  class="text-center">
                            <td colspan="7">
                                Tidak Ada Data
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
