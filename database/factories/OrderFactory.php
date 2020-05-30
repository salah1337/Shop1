<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\User;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {

    $user = User::all()->random();

    return [
        //
        'amount' => $faker->rand(0, 999),
        'shipName' => $faker->$user->firstName.' '.$user->lastName,
        'shipAddress' => $faker->adress,
        'shipAddress2' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->state,
        'zip' => $faker->postcode,
        'country' => $faker->country,
        'phone' => $faker->tollFreePhoneNumber,
        'fax' => $faker->faxNumber,
        'shipping' => $faker->rand(0, 25),
        'tax' => $faker->rand(0, 25).'%',
        'email' => $faker->$user->email,
        'shipped' => $faker->randomElement([true, false]),
        'trackingNumber' => $faker-> Str::random(10),
        'user_id' => $faker->$user->id
    ];
});
