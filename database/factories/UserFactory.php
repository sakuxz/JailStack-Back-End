<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Jail::class, function (Faker $faker) {
    return [
        'hostname' => $faker->name,
        'quota' => $faker->biasedNumberBetween($min = 1, $max = 50, $function = 'sqrt'),
        'ssh_key' => str_random(50),
    ];
});

$factory->define(App\Ip::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'ip' => $faker->ipv4,
    ];
});
