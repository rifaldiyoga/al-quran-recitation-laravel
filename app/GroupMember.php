<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    //

    protected $table = 'detail_group_ngajis';

    protected $fillable = [
        'group_ngaji_id', 'user_id', 'joined_at', 
        'role_type'
    ];

}
