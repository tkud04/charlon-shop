<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug','start_date','end_date','title', 'location', 'pic', 'added_by', 'description' , 'status'
    ];
    
}
