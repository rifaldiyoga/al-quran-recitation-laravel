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
                        Tafsir
                        <br> 
                        <input class="form-check-input" type="checkbox" value="" id="showTafsir" checked="false">
                    </div>
                </div>
                
                
            </div>
        
        </div>
    </div>
    <div class="single-ayat">  
        
        <?php
function arabic_w2e($str)
{
    $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    return str_replace($arabic_western, $arabic_eastern, $str);
}

/**
 * Converts numbers from eastern to western Arabic numerals.
 *
 * @param  string $str Arbitrary text
 * @return string Text with eastern Arabic numerals converted into western Arabic numerals.
 */
function arabic_e2w($str)
{
    $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    return str_replace($arabic_eastern, $arabic_western, $str);
}
?>
        @foreach ($items['verses'] as $data)
        <?php
            $tes = "'".$items['name']['transliteration']['id']."'";
    ?>
        
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <a class="fa fa-bookmark fa-lg" 
                            onclick="
                                bookmark(
                                    {{ $data['number']['inSurah'].', '.$tes.', '.$items['number'] }}
                                    )" style="color:#aeaeaa; cursor: pointer;"></a>
                        <a class="fa fa-play fa-lg ml-10" onclick="play({{ $data['number']['inSurah'] }})" style="color:#aeaeaa; cursor: pointer;"></a>
                        <p class=" ayat text-right float-right ayat-quran mt-20" style="text-align: right; font-size : 30px">{{ $data['text']['arab']." - ".arabic_w2e($data['number']['inSurah']) }}</p>
                    </div>
                    <div class="col-md-12 mt-15">
                        <b class="mb-3 translation">{{ strtoupper($data['text']['transliteration']['en']) }}</b>
                    </div>
                    <div class="col-md-12 mt-10">
                        <p class="mb-3 translate">Terjemahan : <br>{{ $data['translation']['id'] }}</p>
                    </div>
                    <div class="col-md-12 mt-10">
                        <p class="mb-3 tafsir" >Tafsir : <br>{{ $data['tafsir']['id']['short'] }}</p>
                    </div>
                    <div class="col-md-12">
                        <audio id="ayat{{ $data['number']['inSurah'] }}">
                            <source src="{{ $data['audio']['primary'] }}" type="audio/mpeg" style="max-width: 200px"> 
                        </audio>
                    </div>
                </div>
                
                
                    
                <hr>
            </div>
        </div>
        
        @endforeach
    </div>
</main>
@endsection


@section('script')
<script type="application/javascript">
    $(document).ready(function() {
        $('.tafsir').hide();

        $('#showTafsir').change(function() {
        if(!this.checked) {
            $('.tafsir').hide();
        } else {
            $('.tafsir').show();
        }     
    });
    });


    

    function play(params){
        var id = '#ayat'+params;
        $(id).get(0).play();
    }

    function showTafsir(){
        if ($('#check_id').is(":checked"))
        $('.tafsir').hide();
    }

    function bookmark(ayats, surahs, surah_ids){
        var datas = {
            ayat: ayats,
            surah: surahs,
            surah_id: surah_ids
        };
        $.ajax({
            url: '{{ route("surah.bookmark") }}',
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: datas,
            dataType: 'json',
            beforeSend:function() {
                // $("#save").attr('disabled', 'disabled');
            },
            success:function (data) {
                console.log(data);
                alert('Data successfull saved');
            },
            error:function (error) {
                console.log(error)
                alert('Data not saved');
            }
        });  
    }



</script>
@endsection
