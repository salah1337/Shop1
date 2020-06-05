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
    
    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function ableTo($ability){
        return $this->abilities->where('name',$ability)->first() ? true : false;
    }

    public function allowTo($ability){
        $ability = Ability::find($ability);
        if(is_string($ability)){
            $ability =  Ability::whereName($ability)->firstOrFail();
        }
        $this->abilities()->save($ability);
    }
    
    public function unAllow($ability){
        $ability = Ability::find($ability);
        if(is_string($ability)){
            $ability =  Ability::whereName($ability)->firstOrFail();
        }
        $this->abilities()->detach($ability);
    }
}
