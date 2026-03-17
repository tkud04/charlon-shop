<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Posts extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','slug','image','content','tags', 'status'
    ];
    
}
