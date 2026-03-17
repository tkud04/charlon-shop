<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumLikes extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id','user_id'
    ];
    
}
