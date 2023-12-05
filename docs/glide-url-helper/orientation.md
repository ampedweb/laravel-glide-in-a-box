---
layout: page
title: Orientation
parent: Glide URL Helper (Image API)
permalink: /glide-url-helper/orientation
nav_order: 8
---

# Orientation
{: .no_toc }

See original Glide PHP orientation docs [here](https://glide.thephpleague.com/2.0/api/orientation/)

All descriptions are directly quoted from the above docs.

---------------------

## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}
---

## Orientation

Rotates the image. Accepts auto, 0, 90, 180 or 270. Default is auto. The auto option uses Exif data to automatically
orient images correctly.

Rotate the image 90 degrees

```php 
glide_url('/path/to/your_amazing_image.jpeg')->orientation(90)->url()
//With Constants
glide_url('/path/to/your_amazing_image.jpeg')->orientation(Rotate::R90)->url()
```

#### Orientation Constants

```php
namespace AmpedWeb\GlideUrl\Interfaces\Rotate;

Rotate::AUTO // same as "auto"
Rotate::R0 // same as "0"
Rotate::R90  // same as "90"
Rotate::R180 // same as "180"
Rotate::R270 // same as "270"
```