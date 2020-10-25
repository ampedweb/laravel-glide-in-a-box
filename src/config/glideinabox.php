<?php

return [
    'signature_key'     => '9e83e05bbf9b5db17ac0deec3b7ce6cba983f6dc50531c7a919f28d5fb3696c3',
    'cache_path_prefix' => '.cache',
    'base_url'          => 'img',
    'max_image_size' => 50*50,
    'presets' => [
        'small' => [
            'w' => 200,
            'h' => 200,
            'fit' => 'crop',
        ],
        'medium' => [
            'w' => 600,
            'h' => 400,
            'fit' => 'crop',
        ]
    ]
];