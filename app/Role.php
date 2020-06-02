<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 
        'label'
    ];

    public function abilities(){
        return $this->belongsToMany('App\Ability');
    }

    public function allowTo($ability){
        if(is_string($ability)){
            $ability =  Ability::whereName($ability)->firstOrFail();
        }
        return $this->abilities()->save($ability);
    }
}
