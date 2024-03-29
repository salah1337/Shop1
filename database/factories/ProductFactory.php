<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\ProductCategory;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    $names['Cars'] = ['Jeep', 'Honda', 'Fiat',];
    $names['T-shirts'] = ['Shirts', 'Hoodies', 'socks',];
    $names['Laptops'] = ['Accer', 'Lenovo', 'Hp'];

    $category = ProductCategory::all()->random();
    $categoryName = $category->name;
    $index = rand(0, 2);

    $name = $names[$categoryName][$index];

    return [
        'SKU' => $name[0].$name[1].'/'.$categoryName[0].$categoryName[1],
        'name' => $name,
        'price' => rand(5, 1000),
        'tax' => rand(5, 100),
        'weight' => rand(5, 5000),
        'cartDesc' => $faker->text($maxNbChars = 15),
        'shortDesc' => $faker->text($maxNbChars = 100),
        'longDesc' => $faker->text($maxNbChars = 500),
        'thumb' => 'https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg',
        'image' => '["https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg"]',
        'stock' => rand(0, 500),
        'live' => $faker->randomElement([true, false]),
        'unlimited' => $faker->randomElement([true, false]),
        'location' => $faker->streetAddress,
        'product_category_id' => $category->id
    ];
});
