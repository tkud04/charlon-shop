<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class MemberRequests extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code','fname','lname','email','phone'
    ];
    
}
