@extends('layouts.app')

@section('title', 'Ngaji Yuk!')

@section('content')
<main class="container-fluid">
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Nama Surat</td>
                        <td>Detail</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $data)
                    <tr>
                        <td> {{ $data['number'] }}</td>
                        <td>{{ $data['name']['transliteration']['id']. "(".$data['name']['short'].")" }}</td>
                        <td><a href="{{ route('detail-surah', $data['number']) }}"> Detail</a>   </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>   

        </div>
    </div>
</main>
@endsection
