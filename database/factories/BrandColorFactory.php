<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\BrandColor;
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

$factory->define(BrandColor::class, function (Faker $faker) {
    return [
        'brand_id' => 1,
        'color_code' => 'FFFFFF',
    ];
});