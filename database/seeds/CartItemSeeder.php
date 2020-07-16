<?php

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < Cart::all()->count(); $i++) { 
            $cart = Cart::find($i);
            $product = Product::where('live', 1)->get()->random();
            $count = rand(1, 5);
            $item = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'name' => $product->name,
                'count' => $count,
                'price' => $product->price,
                'tax' => $product->tax,
                'options' => 'kek',
                'image' => $product->thumb,
                'description' => $product->cartDesc
            ]);
            $cart->update([
               'total' => $item->price * $item->count
            ]);
        };
    }
}
