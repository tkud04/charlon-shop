<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Products extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug','category','title','image','thumb','description','price','status'
    ];
    
}
