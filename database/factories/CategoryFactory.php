<?php

use A1tem\KnowledgeBase\Tests\User;
use Faker\Generator as Faker;

$factory->define(\A1tem\KnowledgeBase\Models\Category::class, function (Faker $faker) {
    $user = factory(User::class)->create();

    return [
        'user_id' => $user->id,
        'name' => $faker->unique()->name,
    ];
});
