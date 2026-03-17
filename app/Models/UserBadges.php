<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBadges extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'badge_id'
    ];
    
}
