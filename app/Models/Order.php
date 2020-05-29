<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'amount',
        'shipName',
        'shipAddress',
        'shipAddress2',
        'city',
        'state',
        'zip',
        'country',
        'phone',
        'fax',
        'shipping',
        'tax',
        'email',
        'shipped',
        'trackingNumber',
    ];
    function user(){
        return $this->belongsTo('App\Models\User');
    }
    function details(){
        return $this->hasOne('App\Models\OrderDetails');
    }
}
