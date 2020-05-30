<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use App\User;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {

    $user = User::all()->random();

    return [
        //
        'amount' => rand(0, 999),
        'shipName' => $user->firstName.' '.$user->lastName,
        'shipAddress' => $faker->address,
        'shipAddress2' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->state,
        'zip' => $faker->postcode,
        'country' => $faker->country,
        'phone' => $faker->tollFreePhoneNumber,
        'fax' => $faker->postcode,
        'shipping' => rand(0, 25),
        'tax' => rand(0, 25),
        'email' => $user->email,
        'shipped' => $faker->randomElement([true, false]),
        'trackingNumber' => Str::random(10),
        'user_id' => $user->id
    ];
});
