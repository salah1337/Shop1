<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    //
    protected $fillable = [
        'priceIncrement'
    ];
    function product(){
        return $this->belongsTo('App\Models\Product');
    }
    function options(){
        return $this->hasMany('App\Models\Option');
    }
}
