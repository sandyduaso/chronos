<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use User\Models\User;

/**
 *------------------------------------------------------------------------------
 * Model Factories
 *------------------------------------------------------------------------------
 *
 * This directory should contain each of the model factory definitions for
 * your application. Factories provide a convenient way to generate new
 * model instances for testing / seeding your application's database.
 *
 */

$factory->define(User::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $email = $faker->unique()->safeEmail,
        'username' => str_slug($email),
        'password' => 'secret', // $2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm
        'api_token' => '',
        'remember_token' => str_random(10),
    ];
});
