<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'content' => substr($faker->text, 0, 500),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});
