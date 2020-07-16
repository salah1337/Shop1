<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'name', 'count', 'price', 'cart_id', 'product_id', 'options'
    ];

    public function cart(){
        return $this->belongsTo('App\Models\Cart');
    }
    public function product(){
        return $this->hasOne('App\Models\Cart');
    }
}
