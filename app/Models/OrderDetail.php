<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $fillable = [
        'name', 'price', 'SKU', 'quantity'
    ];
    public function order(){
        return $this->belongsTo('App\Models\Order');
    }
    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
