<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        //
        'name' => 
        'SKU' => 
        'price' => 
        'quantity' => 
        'order_id' => 
        'product_id' => 
    ];
});
