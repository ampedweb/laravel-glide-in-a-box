<?php

use League\Flysystem\Adapter\Local;

return [
    'signature_key'     => '9e83e05bbf9b5db17ac0deec3b7ce6cba983f6dc50531c7a919f28d5fb3696c3',
    'cache_path_prefix' => '.cache',
    'base_url'          => 'img',
    'source'            => new Local(public_path('storage')),
    //Example for watermarks
    //'watermarks' => new Local(public_path('storage/watermarks')),
    // watermarks_path_prefix =>'.watermarks'
    'max_image_size'    => 2000 * 2000,
    'presets'           => [
        'small'  => [
            'w'   => 200,
            'h'   => 200,
            'fit' => 'crop',
        ],
        'medium' => [
            'w'   => 600,
            'h'   => 400,
            'fit' => 'crop',
        ]
    ]
];