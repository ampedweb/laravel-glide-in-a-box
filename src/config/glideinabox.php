<?php

return [
    'signature_key'     => 'superduperkey',
    'cache_path_prefix' => '.cache',
    'base_url'          => 'g/img',
    'route_prefix'      => 'g',
    'route_middleware'  => ['web'],
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