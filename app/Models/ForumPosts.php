<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumPosts extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'body', 'img', 'category', 'posted_by' , 'status'
    ];
    
}
