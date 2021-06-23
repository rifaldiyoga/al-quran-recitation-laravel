@extends('layouts.app')

@section('title', 'Setor Bacaan')

@section('content')
<div class="container mt-100">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Setor Bacaan Al-Quran</h1>
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
            <form action="{{ route('grup.setorStore', $data->slug) }}" method="POST">
                @csrf

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="group_type">Pilih Pembimbing</label>
                        <select data-placeholder="Silahkan Pilih Surat" class="list_quran" name="mentor_id"
                            id="mentor_id">
                            <option value=""></option>
                            @foreach ($mentorList as $item)
                            <option value="{{ $item->id }}">{{ Helpers::getTitle($item->gender) ." ".$item->first_name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="group_type">Masukkan Surah Awal</label>
                        <select data-placeholder="Silahkan Pilih Surat" class="list_quran" name="first_surah_id"
                            id="first_surah_id">
                            <option value=""></option>
                            @foreach ($listQuran as $item)
                            <option value="{{ $item['number']."-".$item['numberOfVerses'] }}"
                                {{ !empty($lastRecitation) && $item['number'] < $lastRecitation->last_surah_id ? 'disabled' : ''  }}>
                                {{ $item['name']['transliteration']['id']}}
                            </option>
                            @endforeach
                        </select>
                        <input type="text" id="first_surah" hidden name="first_surah">
                        <input type="text" id="last_surah" hidden name="last_surah">
                        <input type="text" id="fsurah_id" hidden name="fsurah_id">
                        <input type="text" id="lsurah_id" hidden name="lsurah_id">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="group_type">Masukkan Ayat Awal</label>
                        <select data-placeholder="Silahkan Pilih Ayat" class="list_quran" name="first_ayat"
                            
                            id="first_ayat">
                            <option value=""></option>
                            @for ($i = 1; $i <= $item['numberOfVerses'] ; $i++)
                             <option value="{{ $i }}" >{{ $i }}
                                </option>
                                @endfor
                        </select>

                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="group_type">Masukkan Batas Surah</label>
                        <select class="form-control list_quran" name="last_surah_id" id="last_surah_id">
                            <option value=""></option>
                            @foreach ($listQuran as $item)
                            <option value="{{ $item['number']."-".$item['numberOfVerses'] }}" {{ !empty($lastRecitation) && $item['number'] < $lastRecitation->last_surah_id ? 'disabled' : ''  }}>
                                {{  $item['name']['transliteration']['id']}}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="group_type">Masukkan Batas Ayat</label>
                        <select data-placeholder="Silahkan Pilih Ayat" class="list_quran" name="last_ayat"
                            id="last_ayat">
                            <option value=""></option>
                            @for ($i = 1; $i <= $item['numberOfVerses'] ; $i++) <option value="{{ $i }}">{{ $i }}
                                </option>
                                @endfor
                        </select>

                    </div>

                </div>


                <button class="btn main-btn btn-block" type="submit">
                    Simpan
                </button>

            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="application/javascript">
    $(document).ready(function () {
        $('.list_quran').select2({
            theme: 'bootstrap',
            allowClear: false,
            placeholder: "Sliahkan Pilih Surat",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
        });

        $('#first_surah_id').on('change', function () {
            $("#first_surah").val($('#first_surah_id option:selected').text());

            var limit = $(this).val().split("-");
            $("#fsurah_id").val(limit[0]);
            $("#first_ayat")
                .find('option')
                .remove()
                .end();
            for (i = 1; i <= limit[1]; i++) {
                $('#first_ayat').append($('<option>', {
                    value: i,
                    text: "" + i
                }));
            }

        });

        $('#last_surah_id').on('change', function () {
            $("#last_surah").val($('#last_surah_id option:selected').text());
            var limit = $(this).val().split("-");
            $("#lsurah_id").val(limit[0]);
            $("#last_ayat")
                .find('option')
                .remove()
                .end();
            for (i = 1; i <= limit[1]; i++) {
                $('#last_ayat').append($('<option>', {
                    value: i,
                    text: "" + i
                }));
            }

        });

        //     $(function () {
        //    $( "#first_ayat" ).change(function() {
        //       var max = parseInt($(this).attr('max'));
        //       var min = parseInt($(this).attr('min'));
        //       alert(max);
        //       if ($(this).val() > max)
        //       {
        //           $(this).val(max);
        //       }
        //       else if ($(this).val() < min)
        //       {
        //           $(this).val(min);
        //       }       
        //     }); 

    });

</script>
@endsection
