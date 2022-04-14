<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\file;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(file::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'owner_id' => 1,
        'order_id' => 1,
        'path' => 'userName',
    ];
});