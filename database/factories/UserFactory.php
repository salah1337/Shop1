<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {

    $genders = ['male', 'female'];
    $gend = $genders[rand(0, 1)];
    return [
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,

        'gender' => $gend,
        'title' => $faker->title($gender = $gend),
        'firstName' => $faker->firstName($gender = $gend),
        'lastName' => $faker->lastName,
        'city' => $faker->city,
        'state' => $faker->state,
        'zip' => $faker->postcode,
        'ip' => $faker->ipv4,
        'phone' => $faker->tollFreePhoneNumber,
        'fax' => $faker->faxNumber,
        'country' => $faker->country,
        'adress' => $faker->address,
        'adress2' => $faker->address,

        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});