<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\FileNotification;
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

$factory->define(FileNotification::class, function (Faker $faker) {
    return [
        'message' => 'exampleMessage',
        'link' => 'exampleLink',
        'user_id' => 1,
    ];
});