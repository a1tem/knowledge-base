<?php

use A1tem\KnowledgeBase\Tests\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'password' => '12345678'
    ];
});
