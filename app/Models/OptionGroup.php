<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    //
    protected $fillable = [
        'name'
    ];
    function productOptions(){
        return $this->hasMany('App\Models\Option');
    }
}
