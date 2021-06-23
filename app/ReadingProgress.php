<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadingProgress extends Model
{
    //
    protected $table = 'reading_progress';

    protected $fillable = [
        'surah', 'surah_id', 'ayat', 
        'ref_id', 'ref_type'
    ];

}
