<?php

use Faker\Generator as Faker;

$factory->define(App\Author::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'birthday' => $faker->date('Y-m-d'),
        'biography' => $faker->paragraph(),
    ];
});
