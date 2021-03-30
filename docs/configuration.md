---
layout: page 
title: Configuration 
permalink: /configuration 
nav_order: 2
---

# Configuration
{: .no_toc }

Glide In A Box directly maps to the server factory configuration from the original [Glide PHP docs](https://glide.thephpleague.com/). 
{: .fs-6 .fw-300 }

-------------------------

First, publish the config file:

```bash
php artisan vendor:publish --tag=glideinabox  
```

The following file will appear in `/config/glideinabox.php`:

````php
//config/glideinabox.php

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
    /*
     * @see https://glide.thephpleague.com/1.0/config/defaults-and-presets/
     * for further documentation about how presets are defined
     */
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
````

Feel free to configure these much in the same way you would a [server factory in Glide PHP](https://glide.thephpleague.com/1.0/config/setup/#setup-with-factory)
