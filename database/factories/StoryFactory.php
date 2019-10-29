<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Story::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'slug'=> $faker->slug,
        'description' => $faker->text($maxNbChars = 1000),
        'original' => $faker->text($maxNbChars = 20),
        'img' => $faker->imageUrl($width = 640, $height = 480),
        'use_status' => 0,
    ];
});
