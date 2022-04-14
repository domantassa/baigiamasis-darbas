<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ImageRevision;
use Faker\Generator as Faker;

$factory->define(ImageRevision::class, function (Faker $faker) {
    return [
        'path' => 'userName',
        'original_id' => 1,
        'order_id' => 1,
        'name' => $faker->name,
        'status' => 'revision',
        'comment_count' => 1,
        'number' => 1,
    ];
});
