<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    //
    protected $fillable = [
        'priceIncrement', 'option_id', 'option_group_id', 'product_id'
    ];
    function product(){
        return $this->belongsTo('App\Models\Product');
    }
    function options(){
        return $this->hasMany('App\Models\Option');
    }
}
