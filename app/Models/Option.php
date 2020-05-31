<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'option_group_id'
    ];
    function optionGroup(){
        return $this->belongsTo('App\Models\OptionGroup');
    }
    function productOptions(){
        return $this->hasMany('App\Models\ProductOption');
    }
}