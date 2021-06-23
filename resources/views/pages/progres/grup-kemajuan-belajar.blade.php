@extends('layouts.app')

@section('title', 'Progres Setoran Bacaan')

@section('content')
    <div class="container mt-100">
        <div class="row">
            <div class="col">
                <h3>Setoran Bacaan {{ $grup->group_name }}</h3>
                <div class="single-ayat">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <td>No.</td>
                                <td>Nama Santri</td>
                                <td>Grup </td>
                                <td>Bacaan</td>
                                <td>Tanggal Setor</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1; ?>
                        
                            @forelse ($listRecitaion as $item)
                            <?php
                                $status = 'badge-info';
                                if($item->status == 'Approved'){
                                    $status = 'badge-success';
                                }
                                if($item->status == 'Rejected'){
                                    $status = 'badge-danger';
                                }
                            ?>
                            <tr class="text-center">
                                <td >{{ $i }}</td>
                                <td>{{ $item->first_name }}</td>
                                <td>{{ $item->group_name }} </td>
                                <td>{{ $item->first_surah }} : {{ $item->first_ayat }} - {{ $item->last_surah == $item->first_surah ? "" : $item->last_surah." : "   }}{{ $item->last_ayat }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td> <p class="badge badge-pill {{ $status }}">{{ $item->status }}</p></td>
                            </tr>
                             <? $i ++ ?>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center"> Tidak Ada Data</td>
                                </tr>
                            @endforelse 
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

<script type="application/javascript">


function updateStatus(ids, statuss) {
        var datas = {
            id: ids,
            status: statuss,
        };
        $.ajax({
            url: '{{ route("setoran.status") }}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: datas,
            dataType: 'json',
            beforeSend: function () {
                // $("#save").attr('disabled', 'disabled');
            },
            success: function (data) {
                console.log(data);
                location.reload();
                // alert('Data successfull saved');
            },
            error: function (error) {
                console.log(error)
                // alert('Data not saved');
                location.reload();
            }
        });
    }
</script>
    
@endsection