<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecitationProgres extends Model
{
    //
    protected $table = 'recitation_progres';    


    protected $fillable = [
        'first_surah_id', 'first_surah', 'first_ayat', 
        'last_surah_id', 'last_surah', 'last_ayat',
        'created_by', 'status', 'group_ngaji_id',
        'mentor_id'
    ];
}
