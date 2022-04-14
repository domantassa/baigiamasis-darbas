<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ImageComment;
use Faker\Generator as Faker;

$factory->define(ImageComment::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'image_revision_id' => 1,
        'user_name' => $faker->name,
        'comment' => 'exampleComment',
        'x' => 350,
        'y' => 450,
        'number' => 1,

    ];
});
