<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'from' => $faker->name,
        'message' => $faker->paragraph()
    ];
});
