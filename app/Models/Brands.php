<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Brands extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug','title','img'
    ];
    
}
