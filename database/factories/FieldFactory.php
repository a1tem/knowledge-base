<?php

use A1tem\KnowledgeBase\Models\Category;
use A1tem\KnowledgeBase\Models\Field;
use Faker\Generator as Faker;

$factory->define(Field::class, function (Faker $faker) {
    $category = factory(Category::class)->create();

    return [
        'category_id' => $category->id,
        'label' => $faker->unique()->word,
        'type' => Field::TYPE_TEXT,
        'default_value' => $faker->unique()->word,
        'meta_data' => [],
        'is_required' => $faker->boolean
    ];
});

