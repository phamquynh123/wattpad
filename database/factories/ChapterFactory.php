<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Chapter::class, function (Faker $faker) {
    return [
        'story_id' => 3,
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'slug' =>$faker->slug,
        'content' => $faker->text($maxNbChars = 10000),
        'public_status' => 0,
        'parent_language_id' => 0,
        'language_id' => 1,
    ];
});
