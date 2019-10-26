<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Category::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'slug' => $faker->slug,
        'description' =>$faker->
        'parent_id',
        'language_id',
        'parent_language_id',
    ];
});
// Ngaf nguyen https://www.facebook.com/profile.php?id=100009709511594
// Nguyễn Nhuư Quỳnh https://www.facebook.com/profile.php?id=100008861051687

// loại: Thắm nguyen https://www.facebook.com/nguyentham98hn
