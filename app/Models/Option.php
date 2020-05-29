<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    //
    protected $fillable = [
        'name'
    ];
    function optionGroup(){
        return $this->belongsTo('App\Models\OptionGroup');
    }
    function productOptions(){
        return $this->hasMany('App\Models\ProductOption');
    }
}
