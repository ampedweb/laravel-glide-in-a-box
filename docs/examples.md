---
layout: page
title: Examples
permalink: /examples
nav_order: 4
---

# Examples

## Using a preset

```php
/// Presets live inside the $presets array in config/glideinabox.php

$presets = [
    'list' => [
        'w'   => 300,
        'h'   => 300,
        'fit' => 'max',
        'fm'  => 'jpg'
    ]
];
```

### The basic image

```php
// Here's the image as defined in the preset
$jpegImage = glide_url('/path/to/your/image.jpg')->preset('list')->url();
```

### Change the encoding

```php
// I want it in WebP for modern times!
$webpImage = glide_url('/path/to/your/image.jpg')->preset('list')->webp()->url();

// Now in PNG
$pngImage = glide_url('/path/to/your/image.jpg')->preset('list')->png()->url();

// Or as a lower quality JPEG
$lowQualityJpegImage = glide_url('/path/to/your/image.jpg')->preset('list')->quality(40)->url();
```

### Manipulate the image

#### Resize

```php
// A larger WebP
$largerImage = glide_url('/path/to/your/image.jpg')->preset('list')->size(640, 480)->webp()->url();
```

#### Brighten
```php
$brighterImage = glide_url('/path/to/your/image.jpg')->preset('list')->bri(75)->url();
```

#### Darken
```php
$darkerImage = glide_url('/path/to/your/image.jpg')->preset('list')->bri(-75)->url();
```

#### Chain as many manipulations as you want

```php
use AmpedWeb\GlideInABox\Interfaces\Border;
use AmpedWeb\GlideInABox\Interfaces\Crop;
use AmpedWeb\GlideInABox\Interfaces\Filter;

$image = glide_url('/path/to/your/image.jpg')->preset('list')
                                             ->cropToPosition(400, 400, Crop::BOTTOM_LEFT)
                                             ->sharpen(20)
                                             ->brightness(3)
                                             ->contrast(20)
                                             ->border(2, 'AABBCCDD', Border::OVERLAY)
                                             ->filter(Filter::SEPIA)
                                             ->webp()
                                             ->url();
```

## Working without a preset

### Basic resized image

```php
$image = glide_url('/path/to/your/image.jpg')->size(300, 300)->fit('max')->jpeg()->url();
```

### Using several manipulations
```php
use AmpedWeb\GlideInABox\Interfaces\Border;
use AmpedWeb\GlideInABox\Interfaces\Crop;
use AmpedWeb\GlideInABox\Interfaces\Filter;

$image = glide_url('/path/to/your/image.jpg')->cropToPosition(400, 400, Crop::BOTTOM_LEFT)
                                             ->sharpen(20)
                                             ->brightness(3)
                                             ->contrast(20)
                                             ->border(2, 'AABBCCDD', Border::OVERLAY)
                                             ->filter(Filter::SEPIA)
                                             ->webp()
                                             ->url();
```