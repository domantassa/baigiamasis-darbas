<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Order;
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

$factory->define(Order::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'owner_id' => 1,
        'file_id' => 1,
        'brand_id' => 1,
        'type' => 'exampleType',
        'state' => 'exampleState',
        'brand' => 'exampleBrand',
        'result' => 'exampleResult',
        'requirements' => 'exampleRequirements',
        'comment' => 'exampleComment',
        'feedback' => 'exampleFeedback',
        'number_of_revisions' => 1,
        'expected_at' => 'exampleExpectedDate',
    ];
});