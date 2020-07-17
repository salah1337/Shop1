<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OptionGroup extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];
    function options(){
        return $this->hasMany('App\Models\Option');
    }
}