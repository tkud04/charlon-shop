<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Orders extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','payment_mode','cc','bd', 'sku', 'status' 
    ];
    
}
