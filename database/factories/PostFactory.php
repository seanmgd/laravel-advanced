<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'active' => random_int(0,1)
    ];
    // Then write this on php artisan tinker factory(\App\Post::class, 50)->create()
});
