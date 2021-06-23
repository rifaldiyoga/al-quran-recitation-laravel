@extends('layouts.app')

@section('title', $items['name']['transliteration']['id'])

@section('content')
<main class="container mt-100">
    <div class="row">
        <div class="col-md-12">
            <div class="single-ayat">
                <div class="row">
                    <div class="col-md-6">

                        <h3>{{ $items['name']['transliteration']['id'] }}</h3>
                        <h3 class="ayat-quran">{{ "(".$items['name']['short'].")" }}</h3>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
                <ul class="nav nav-tabs mt-10" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#surah" role="tab" data-toggle="tab">Surah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#infosurah" role="tab" data-toggle="tab">Informasi Surah</a>
                    </li>
                </ul>

                <div class="tab-content pt-20">
                    <div role="tabpanel" class="tab-pane fade-in active" id="surah">
                        <div class="row">
                            <div class="col">
                                <div class="custom-control custom-switch text-right">
                                    <input type="checkbox" class="custom-control-input" id="autoPlay" checked>
                                    <label class="custom-control-label" for="autoPlay">Auto Play Ayat</label>
                                </div>
                                <div class="custom-control custom-switch text-right">
                                    <input type="checkbox" class="custom-control-input" id="showTafsir" checked>
                                    <label class="custom-control-label" for="showTafsir">Menampilkan Tafsir Ayat</label>
                                </div>
                            </div>
                        </div>
                        @foreach ($items['verses'] as $data)
                        <?php $tes = "'".$items['name']['transliteration']['id']."'"; ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a class="fa fa-bookmark fa-lg" onclick="
                                bookmark(
                                    {{ $data['number']['inSurah'].', '.$tes.', '.$items['number'] }}
                                    )" style="color:#aeaeaa; cursor: pointer;"></a>
                                        <a class="fa fa-play fa-lg ml-10 player" id="button{{ $data['number']['inSurah'] }}"
                                            onclick="play({{ $data['number']['inSurah'] }})"
                                            style="color:#aeaeaa; cursor: pointer;"></a>
                                        <p class=" ayat text-right float-right ayat-quran mt-20"
                                            style="text-align: right; font-size : 30px">
                                            {{ $data['text']['arab']." - ".Helper::arabic_w2e($data['number']['inSurah']) }}
                                        </p>
                                    </div>
                                    <div class="col-md-12 mt-15">
                                        <b
                                            class="mb-3 translation">{{ strtoupper($data['text']['transliteration']['en']) }}</b>
                                    </div>
                                    <div class="col-md-12 mt-10">
                                        <p class="mb-3 translate">Terjemahan : <br>{{ $data['translation']['id'] }}</p>
                                    </div>
                                    <div class="col-md-12 mt-10">
                                        <p class="mb-3 tafsir">Tafsir : <br>{{ $data['tafsir']['id']['short'] }}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <audio id="ayat{{ $data['number']['inSurah'] }}">
                                            <source src="{{ $data['audio']['primary'] }}" type="audio/mpeg"
                                                style="max-width: 200px">
                                        </audio>
                                    </div>
                                </div>



                                <hr>
                            </div>
                        </div>

                        @endforeach
                    </div>
                    <div role="tabpanel" class="tab-pane " id="infosurah" style="font-size: 17px;">
                        <div class="row">
                            <div class="col text-center">
                                <p style="font-weight: bold">Arti Surah<p>
                                        <p>{{ $items['name']['translation']['id'] }}<p>
                            </div>
                            <div class="col text-center">
                                <p style="font-weight: bold">Jumlah Ayat<p>
                                        <p>{{ $items['numberOfVerses'] }}<p>
                            </div>
                            <div class="col text-center">
                                <p style="font-weight: bold">Tergolong surah<p>
                                        <p>{{ $items['revelation']['id'] }}<p>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Tafsir : <br>{{ $items['tafsir']['id'] }}
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</main>
@endsection


@section('script')
<script type="application/javascript">
    var playing = false;
    var ayat_id = 0;

    function play(params) {
        var id = '#ayat' + params;
        var button_id = '#button' + params;

        $('#button'+params).removeClass().addClass("fa fa-pause fa-lg ml-10");
        $('html, body').animate({
            scrollTop: $('#button'+params).offset().top -200
        }, 2000);
        if(!$(id).get(0).paused){
            $(id).get(0).pause();
            $('#button'+params).removeClass().addClass("fa fa-play fa-lg ml-10");
        } else{
            $(id).get(0).play();
        }
        
    }

    $(document).ready(function () {
        // $('.tafsir').hide();
        $('.select-surat').select2({
            theme: 'bootstrap'
        });
        $('#showTafsir').change(function () {
            if (!this.checked) {
                $('.tafsir').hide();
            } else {
                $('.tafsir').show();
            }
        });

        $('#ayat' + ayat_id).on('playing', function () {
            playing = true;
            alert(true);
            // disable button/link
        });
        $('#ayat' + ayat_id).on('ended', function () {
            playing = false;
            alert(false);
            // enable button/link
        });

        $('audio').on('ended', function (e) {
            var endedTag = e.target
            .id; //this gives the ended audio, so you can find the next one and play it.
            
            var surah_id = endedTag.substring(4, endedTag.length);
            $('#button'+surah_id).removeClass().addClass("fa fa-play fa-lg ml-10");
            
            if($('#autoPlay').is(':checked')){
                play(parseInt(surah_id) + 1);
            }

        });


        
    });







    function showTafsir() {
        if ($('#check_id').is(":checked"))
            $('.tafsir').hide();
    }

    function bookmark(ayats, surahs, surah_ids) {
        var datas = {
            ayat: ayats,
            surah: surahs,
            surah_id: surah_ids
        };
        $.ajax({
            url: '{{ route("surah.bookmark") }}',
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
                alert('Data successfull saved');
            },
            error: function (error) {
                console.log(error)
                alert('Data not saved');
            }
        });
    }

    $(document).ready(function () {});

</script>
@endsection
