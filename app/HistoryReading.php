<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HistoryReading extends Model
{
    //

    protected $table = 'history_reading';    


    protected $fillable = [
        'first_surah_id', 'first_surah', 'first_ayat', 
        'last_surah_id', 'last_surah', 'last_ayat',
        'created_by', 'status', 'group_ngaji_id'
    ];
}
