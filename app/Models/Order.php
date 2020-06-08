<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    
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
        'user_id'
    ];
    function user(){
        return $this->belongsTo('App\User');
    }
    function details(){
        return $this->hasMany('App\Models\OrderDetail');
    }
}
