<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\ProductCategory;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {

    $names['T-shirts'] = ['Jeep', 'Honda', 'Fiat',];
    $names['Cars'] = ['Shirts', 'Hoodies', 'socks',];
    $names['Laptops'] = ['Accer', 'Lenovo', 'Hp'];

    $category = ProductCategory::all()->random();
    $categoryName = $category->name;
    $index = rand(0, 2);

    $name = $names[$categoryName][$index];

    return [
        'SKU' => $name[0].$name[1].'/'.$categoryName[0].$categoryName[1],
        'name' => $name,
        'price' => rand(5, 1000).' dollars',
        'weight' => rand(5, 5000).' grams',
        'cartDesc' => $factory->text($maxNbChars = 15),
        'shortDesc' => $factory->text($maxNbChars = 100),
        'longDesc' => $factory->text($maxNbChars = 500),
        'thumb' => '/'.$category->name.'/'.$name.'Thumb'.'.jpg',
        'image' => '/'.$category->name.'/'.$name.'jpg',
        'stock' => rand(0, 500),
        'live' => $faker->randomElement([true, false]),
        'unlimited' => $faker->randomElement([true, false]),
        'location' => $factory->streetAddress,
        'category_id' => $category->id
    ];
});
