<?php

use Faker\Generator as Faker;

$factory->define(App\Photo::class, function (Faker $faker) {
    return [
        'id' => str_random(12),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'filename' => str_random(12) . '.jpg',
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
