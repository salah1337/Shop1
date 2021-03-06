<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 
        'email', 
        'password',
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
        'adress',
        'adress2',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cart(){
        return $this->hasOne('App\Models\Cart');
    }
    
    public function orders(){
        return $this->hasMany('App\Models\Order');
    }
    public function addresses(){
        return $this->hasMany('App\Address');
    }

    public function token(){
        return $this->hasMany('\App\OauthAccessToken');
    }

    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    public function assignRole($role){
        if(is_string($role)){
            $role =  Role::whereName($role)->firstOrFail();
        }
        $this->roles()->sync($role, false);
    }
    
    public function revokeRole($role){
        if(is_string($role)){
            $role =  Role::whereName($role)->firstOrFail();
        }
        $this->roles()->detach($role);
    }
    
    public function isA($role){
        return $this->roles()->where('name', $role)->first() ? true : false;
    }

    public function abilities(){
        return $this->roles->map->abilities->flatten()->pluck('name')->unique();
    }

    public function ableTo($ability){
        return $this->roles->map->abilities->flatten()->where('name', $ability)->first();
    }

}
