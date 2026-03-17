<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Banners extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','subtitle','points','description','image','btn_url_1','btn_text_1','btn_url_2','btn_text_2','status'
    ];
    
}
