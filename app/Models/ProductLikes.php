<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductLikes extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_slug','user_id'
    ];
    
}
