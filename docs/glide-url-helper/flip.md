---
layout: page
title: Flip
parent: Glide URL Helper (Image API)
permalink: /glide-url-helper/flip
nav_order: 7
---
# Flip
{: .no_toc }

See original Glide PHP crop docs [here](https://glide.thephpleague.com/2.0/api/flip/)

All descriptions are directly quoted from the above docs.

---------------------
## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}
---

## Flip

Flips the image. Accepts v, h and both.

Vertically flip the image

```php 
glide_url('/path/to/your_amazing_image.jpeg')->flip('v')->url()
//OR
glide_url('/path/to/your_amazing_image.jpeg')->flip(Flip::VERTICAL)->url()
```

#### Flip Constants
```php
namespace AmpedWeb\GlideInABox\Interfaces\Flip;

Flip::VERTICAL // same as "v"
Flip::HORIZONTAL // same as "h"
Flip::BOTH // same as 'both'
```