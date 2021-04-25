<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class GroupNgaji extends Model
{
    //

    use SoftDeletes;

    protected $fillable = [
        'group_name', 'group_desc', 'img_src', 
        'slug', 'created_by', 'group_type',
        'access_type'
    ];


    protected $hidden = [

    ];
}
