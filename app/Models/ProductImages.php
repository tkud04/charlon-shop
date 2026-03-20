<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductImages extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_slug','url'
    ];
    
}
