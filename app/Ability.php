<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    protected $fillable = [
        'name', 
        'label'
    ];
    
    public function role(){
        return $this->belongsToMany(App\Role)->withTimestampes();
    }
}
