<?php

use Faker\Generator as Faker;

$factory->define(App\Supplier::class, function (Faker $faker) {
    return [
        'name'		=> $faker->name,
        'mobile'	=> $faker->phoneNumber,
        'email'		=> $faker->unique()->safeEmail,
        'address'	=> $faker->address
    ];
});
