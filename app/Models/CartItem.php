<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CartItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'count', 'price', 'cart_id', 'product_id', 'options', 'tax', 'image', 'description'
    ];

    public function cart(){
        return $this->belongsTo('App\Models\Cart');
    }
    public function product(){
        return $this->hasOne('App\Models\Cart');
    }
}
