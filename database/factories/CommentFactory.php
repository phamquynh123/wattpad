<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Comment::class, function (Faker $faker) {
    return [
        'story_id' => 1,
        'user_id' => 1,
        'content' => $faker->sentence($nbWords = 10, $variableNbWords = true),
    ];
});
