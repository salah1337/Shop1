<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'SKU',
        'name',
        'price',
        'tax',
        'weight',
        'cartDesc',
        'shortDesc',
        'longDesc',
        'thumb',
        'image',
        'stock', 
        'live',
        'unlimited',
        'location',
        'product_category_id',
        'featured'
    ];
    public function carts(){
        return $this->belongsToMany('App\Models\Cart');
    }
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
