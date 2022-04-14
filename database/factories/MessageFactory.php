<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Message;
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

$factory->define(Message::class, function (Faker $faker) {
    return [
        'message' => 'exampleMessage',
        'sender_user_id' => 1,
        'receiver_user_id' => 1,
        'seen_date' => '2022-04-03 14:09:36',
    ];
});