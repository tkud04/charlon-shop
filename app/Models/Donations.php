<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donations extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'amount', 'status'
    ];
    
}
