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
$jpegImage = (string)glide_url('/path/to/your/image.jpg')->preset('list');
```

### Change the encoding

```php
// I want it in WebP for modern times!
$webpImage = (string)glide_url('/path/to/your/image.jpg')->preset('list')->webp();

// Now in PNG
$pngImage = (string)glide_url('/path/to/your/image.jpg')->preset('list')->png();

// Or as a lower quality JPEG
$lowQualityJpegImage = (string)glide_url('/path/to/your/image.jpg')->preset('list')->quality(40);
```

### Manipulate the image

#### Resize

```php
// A larger WebP
$largerImage = (string)glide_url('/path/to/your/image.jpg')->preset('list')->size(640, 480)->webp();
```

#### Brighten
```php
$brighterImage = (string)glide_url('/path/to/your/image.jpg')->preset('list')->bri(75);
```

#### Darken
```php
$darkerImage = (string)glide_url('/path/to/your/image.jpg')->preset('list')->bri(-75);
```

#### Chain as many manipulations as you want

```php
use AmpedWeb\GlideInABox\Interfaces\Border;
use AmpedWeb\GlideInABox\Interfaces\Crop;
use AmpedWeb\GlideInABox\Interfaces\Filter;

$image = (string)glide_url('/path/to/your/image.jpg')->preset('list')
                                                     ->cropToPosition(400, 400, Crop::BOTTOM_LEFT)
                                                     ->sharpen(20)
                                                     ->brightness(3)
                                                     ->contrast(20)
                                                     ->border(2, 'AABBCCDD', Border::OVERLAY)
                                                     ->filter(Filter::SEPIA)
                                                     ->webp();
```

## Working without a preset

### Basic resized image

```php
$image = glide_url('/path/to/your/image.jpg')->size(300, 300)->fit('max')->jpeg();
```

### Using several manipulations
```php
use AmpedWeb\GlideInABox\Interfaces\Border;
use AmpedWeb\GlideInABox\Interfaces\Crop;
use AmpedWeb\GlideInABox\Interfaces\Filter;

$image = (string)glide_url('/path/to/your/image.jpg')->cropToPosition(400, 400, Crop::BOTTOM_LEFT)
                                                     ->sharpen(20)
                                                     ->brightness(3)
                                                     ->contrast(20)
                                                     ->border(2, 'AABBCCDD', Border::OVERLAY)
                                                     ->filter(Filter::SEPIA)
                                                     ->webp();
```
          
## In Blade Templates

### The basic image

```php
{{ glide_url('/path/to/your/image.jpg')->preset('list') }}
```

### Change the encoding

```php
{{-- I want it in WebP for modern times! --}}
{{ glide_url('/path/to/your/image.jpg')->preset('list')->webp() }}

{{-- Now in PNG --}}
{{ glide_url('/path/to/your/image.jpg')->preset('list')->png() }}

{{-- Or as a lower quality JPEG --}}
{{ glide_url('/path/to/your/image.jpg')->preset('list')->quality(40) }}
```


## What happened to the `url()` method?  Can I still use it?

As of version 0.4.0, FluentUrlBuilder has been made "stringable" by implementing `__toString()`.
What this means is that you can cast to `(string)` or `print` an instance instead of needing to 
call `url()`.

### Why?  Why have you done this?!

It has always felt clunky to have to call `url()` to get the URL - a pain point in an otherwise
pleasant experience.  As the primary purpose of this package is to provide a pleasant interface
over Glide, we thought that this needed to be improved.

### Does this break backwards compatibility?

No.  The `url()` method is still available.

So don't worry - you don't need to change any of your existing code (unless you want to).