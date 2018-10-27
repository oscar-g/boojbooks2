<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'title' => $faker->title(),
        'publication_date' => $faker->date('Y-m-d'),
        'description' => $faker->paragraph(),
        'pages' => $faker->randomNumber(),
        'author_id' => function() {
            return factory(App\Author::class)->create()->id();
        },
    ];
});
