@extends('layouts.app')

@section('title', 'Setoran Bacaan')

@section('content')
<div class="container mt-100">
    <div class="row">
        <div class="col">
            <h3>Setoran Bacaan Santri</h3>
            <div class="single-ayat">
                
                <form action="{{ route('setoran.search') }}" method="get">
                <div class="row justify-content-end">
                    <div class="col-md-2 mb-2">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Input nama" value="{{ old('name') }}">
                    </div>
                    <div class="col-md-2 mb-2">
                        <select name="group_id" id="group_id" class="form-control" aria-placeholder="Berdasarkan Grup">
                            <option disabled selected value> -- select an option -- </option>
                            @foreach ($groupList as $item)
                                
                                <option value="{{ $item->id }}">{{ $item->group_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 mb-2">
                        <select name="status" id="status" class="form-control">
                            <option value="Waiting">Waiting</option>
                            <option value="All">All</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                        
                    </div>
                    <div class="col-md-1">

                    <button class="btn btn-info" type="submit"><i class="fa fa-search"></i>  </button>
                    </div>
                </div>
                </form>
                
                <table class="table table-responsive-md mt-10" style="overflow: auto">
                    <thead>
                        <tr class="text-center">
                            <td>No.</td>
                            <td>Nama Santri</td>
                            <td>Grup </td>
                            <td>Bacaan</td>
                            <td>Tanggal Setor</td>
                            <td  style="min-width">Status</td>
                            
                            @if (Auth::user()->user_type == 1)
                                <td  style="min-width:13%">Action</td>
                            @endif
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
                            <td>{{ $i }}</td>
                            <td>{{ $item->first_name }}</td>
                            <td>{{ $item->group_name }} </td>
                            <td>{{ $item->first_surah }} : {{ $item->first_ayat }} -
                                {{ $item->last_surah == $item->first_surah ? "" : $item->last_surah." : "   }}{{ $item->last_ayat }}
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <p class="badge badge-pill {{ $status }}">{{ $item->status }}</p>
                            </td>
                            @if (Auth::user()->user_type == 1)
                            <td >
                                        <button class="btn btn-success" onclick="updateStatus({{ $item->id }}, 'Approved')"><i
                                        class="fa fa-check "></i></button>
                                        <button class="btn btn-danger" onclick="updateStatus({{ $item->id }}, 'Rejected')"><i
                                            class="fa fa-close "></i></button>
                                
                                </div>
                            </td>
                            @endif
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



<div class="modal fade" id="modalSaya" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSayaLabel">Filter Setoran Bacaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Cari Berdasarkan Nama</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="col-md-6">
                            <label for="">Cari Berdasarkan Grup</label>
                            <select name="group_id" id="group_id" class="form-control">
                                @foreach ($groupList as $item)
                                    
                                    <option value="{{ $item->id }}">{{ $item->group_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="">Cari Berdasarkan Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="Waiting">Waiting</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" >Oke</button>
            </div>
        </div>
    </div>
</form>
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
                console.log(error);
location.reload();
            }
            
        });
    }

</script>

@endsection
