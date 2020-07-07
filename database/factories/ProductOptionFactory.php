<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductOption;
use App\Models\Product;
use App\Models\Option;
use App\Models\OptionGroup;

use Faker\Generator as Faker;

$factory->define(ProductOption::class, function (Faker $faker) {

    $option = Option::all()->random();

    return [
        'priceIncrement' => rand(1, 25),
        'option_id' => $option->id,
        'product_id' => Product::all()->random()->id,
        'option_group_id' => $option->option_group_id
    ];
});
