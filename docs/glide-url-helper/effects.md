---
layout: page
title: Effects
parent: Glide URL Helper (Image API)
permalink: /glide-url-helper/effects
nav_order: 5
---

# Effects
{: .no_toc }

See original Glide PHP effects docs [here](https://glide.thephpleague.com/2.0/api/effects/)

All descriptions are directly quoted from the above docs.

---------------------

## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}
---

## Blur

Adds a blur effect to the image. Use values between 0 and 100.

```php 
glide_url('/path/to/your_amazing_image.jpeg')->blur(5)->url()
```

----------------------

## Pixelate

Applies a pixelation effect to the image. Use values between 0 and 1000.

```php 
glide_url('/path/to/your_amazing_image.jpeg')->pixel(5)->url()
//OR
glide_url('/path/to/your_amazing_image.jpeg')->pixelate(5)->url()
```

----------------------

## Filter

Applies a filter effect to the image. Accepts greyscale or sepia.

```php 
glide_url('/path/to/your_amazing_image.jpeg')->filt('greyscale')->url()
//OR
glide_url('/path/to/your_amazing_image.jpeg')->filter('greyscale')->url()

//With Constants
glide_url('/path/to/your_amazing_image.jpeg')->filt(Filter::GREYSCALE)->url()
//OR
glide_url('/path/to/your_amazing_image.jpeg')->filter(Filter::GREYSCALE)->url()
```

#### Filter Constants

```php
namespace AmpedWeb\GlideUrl\Interfaces\Filter;

Filter::GREYSCALE // same as "greyscale"
Filter::SEPIA // same as "sepia"
```