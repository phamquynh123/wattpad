<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text($maxNbChars = 1000),
        'avatar' => $faker->imageUrl($width = 640, $height = 480),
        'role_id' => '2',
        'password' => Hash::make('123456'),
        'email' => 'user3@gmail.com',
    ];
});
