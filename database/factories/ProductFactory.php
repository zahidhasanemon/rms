<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name'		=> $faker->word,
        'category_id'	=> $faker->numberBetween(1, 5),
        'sub_category_id'	=> $faker->numberBetween(1, 10),
        'details'	=> $faker->paragraph,
        'image'		=> 'default.png',
    ];
});
