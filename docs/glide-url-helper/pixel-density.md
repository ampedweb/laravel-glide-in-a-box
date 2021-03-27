---
layout: page
title: Pixel Density
parent: Glide URL Helper (Image API)
permalink: /glide-url-helper/pixel-density
nav_order: 9
---
# Pixel Density
{: .no_toc }

See original Glide PHP crop docs [here](https://glide.thephpleague.com/2.0/api/pixel-density/)

All descriptions are directly quoted from the above docs.

## Pixel Density

The device pixel ratio is used to easily convert between CSS pixels and device pixels. This makes it possible to display images at the correct pixel density on a variety of devices such as Apple devices with Retina Displays and Android devices. You must specify either a width, a height, or both for this parameter to work. The default is 1. The maximum value that can be set for dpr is 8.

```php 
glide_url('/path/to/your_amazing_image.jpeg')->width(250)->dpr(2)->url()
```