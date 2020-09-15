<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'title',
        'gender',
        'firstName',
        'lastName',
        'city',
        'state',
        'zip',
        'ip',
        'image',
        'phone',
        'fax',
        'country',
        'address',
        'address2',
        'user_id'
    ];
    function user(){
        return $this->belongsTo('App\User');
    }
}
