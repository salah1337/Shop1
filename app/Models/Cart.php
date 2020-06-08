<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id'
    ];
    
    public function user(){
        return $this->belongsToOne('App\User');
    }

    public function items(){
        return $this->hasMany('App\Models\CartItem');
    }

    public function has($product){
        return $this->items()->where('id', $product->id)->first() ? true : false;
    }

    public function add($product){
        $this->items()->save($product);
    }
    
    public function remove($product){
        $this->items()->detach($product);
    }
    
    public function clear(){
        foreach ($this->items() as $key => $product) {
            $this->items()->detach($product);
        }
        return $this->items();
    }
}
