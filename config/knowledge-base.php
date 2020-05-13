<?php

return [
    // Database tables prefix
    'table_prefix' => 'knowledge_base_',
    'pagination_count' => 10,
    'user_model' => 'App\User',
    'order_by' => [
        'category' => 'name',
        'article' => 'title'
    ],
    // Note: This directory must exist and be writable by the webserver process.
    'save_images_to' => 'public/images'
];
