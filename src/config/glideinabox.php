<?php

return [
    //'imageController' => YourImageController::class,
    'signature_key'     => null,
    'cache_path_prefix' => '.cache',
    'base_url'          => 'img',
    'source'            => public_path('storage'),
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