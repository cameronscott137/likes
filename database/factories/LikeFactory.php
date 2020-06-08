<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Like;
use Illuminate\Support\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Like::class, function (Faker $faker) {
    return [
        'twitter_id' => random_int(10000, 99999),
        'text' => $faker->sentence(),
        'author_name' => $faker->name(),
        'author_username' => $faker->userName(),
        'author_avatar_url' => $faker->imageUrl(48, 48),
        'created_at' => Carbon::now()->subDay(rand(0, 99))
    ];
});
