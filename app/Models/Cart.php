<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id', 'total'
    ];
    
    public function user(){
        return $this->belongsToOne('App\User');
    }

    public function items(){
        return $this->hasMany('App\Models\CartItem');
    }

    public function has($product){
        return $this->items()->where('product_id', $product->id)->first() ? true : false;
    }

    public function add($item){
        $this->items()->save($item);
    }
    
    public function remove($item){
        $this->items()->detach($item);
    }
    
    public function clear(){
        foreach ($this->items() as $key => $item) {
            $this->items()->detach($item);
        }
        return $this->items();
    }
}
