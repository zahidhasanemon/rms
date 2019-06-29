<?php

use Faker\Generator as Faker;

$factory->define(App\SubCategory::class, function (Faker $faker) {
    return [
        'name'		=> $faker->word,
        'category_id'	=> $faker->numberBetween(1, 5),
        'details'	=> $faker->paragraph,
    ];
});
