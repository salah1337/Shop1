<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'SKU',
        'name',
        'price',
        'weight',
        'cartDesc',
        'shortDesc',
        'longDesc',
        'thumb',
        'image',
        'stock',
        'live',
        'unlimited',
        'location ',
        'category_id'
    ];
    function options(){
        return $this->hasMany('App\Models\ProductOption');
    }
    function orderDetails(){
        return $this->hasMany('App\Models\OrderDetails');
    }
    function category(){
        return $this->belongsTo('App\Models\ProductCategory');
    }
}
