<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(OrderDetail::class, function (Faker $faker) {

    $order = Order::all()->random();
    $product = Product::all()->random();

    $user = $order->user;

    $quantity = rand(1, 10);

    return [
        //
        'name' => $user->username."'s ".$product->name.' orderDetails',
        'SKU' =>  $product->SKU,
        'price' => $product->price * $quantity,
        'quantity' => $quantity,
        'order_id' => $order->id,
        'options' => 'kek',
        'product_id' => $product->id
    ];
});
