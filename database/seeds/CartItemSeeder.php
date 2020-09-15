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
                'options' => '[{"id":3,"created_at":"2020-09-08T16:56:39.000000Z","updated_at":"2020-09-08T16:56:39.000000Z","priceIncrement":9,"option_id":7,"option_group_id":1,"product_id":3,"name":"red","group":{"id":1,"created_at":null,"updated_at":null,"deleted_at":null,"name":"colors"},"option":{"id":7,"created_at":"2020-09-08T16:56:32.000000Z","updated_at":"2020-09-08T16:56:32.000000Z","deleted_at":null,"name":"red","option_group_id":1}},{"id":18,"created_at":"2020-09-08T16:56:40.000000Z","updated_at":"2020-09-08T16:56:40.000000Z","priceIncrement":8,"option_id":2,"option_group_id":2,"product_id":3,"name":"small","group":{"id":2,"created_at":null,"updated_at":null,"deleted_at":null,"name":"sizes"},"option":{"id":2,"created_at":"2020-09-08T16:56:32.000000Z","updated_at":"2020-09-08T16:56:32.000000Z","deleted_at":null,"name":"small","option_group_id":2}}]',
                'image' => $product->thumb,
                'description' => $product->cartDesc
            ]);
            $cart->update([
               'total' => $item->price * $item->count
            ]);
        };
    }
}
