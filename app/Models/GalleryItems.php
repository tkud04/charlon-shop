<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class GalleryItems extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','type','img','date'
    ];
    
}
