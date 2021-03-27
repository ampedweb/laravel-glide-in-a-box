---
layout: page
title: Encode
parent: Glide URL Helper (Image API)
permalink: /glide-url-helper/encode
nav_order: 6
---
# Encode
{: .no_toc }

See original Glide PHP crop docs [here](https://glide.thephpleague.com/2.0/api/encode/)

All descriptions are directly quoted from the above docs.

---------------------
## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}
---

## Quality

Defines the quality of the image. Use values between 0 and 100. Defaults to 90. Only relevant if the format is set to jpg or pjpg.

```php 
glide_url('/path/to/your_amazing_image.jpeg')->q(25)->url()
//OR
glide_url('/path/to/your_amazing_image.jpeg')->quality(25)->url()
```
----------------------
## Format

Encodes the image to a specific format. Accepts jpg, pjpg (progressive jpeg), png, gif or webp. Defaults to jpg.

80% Quality of any format. Quality is param is optional.

```php 
//JPEG
glide_url('/path/to/your_amazing_image.jpeg')->jpeg(80)->url()

//PJPEG
glide_url('/path/to/your_amazing_image.jpeg')->pjpeg(80)->url()

//PNG
glide_url('/path/to/your_amazing_image.jpeg')->png(80)->url()

//WEBP
glide_url('/path/to/your_amazing_image.jpeg')->webp(80)->url()

//GIF
glide_url('/path/to/your_amazing_image.jpeg')->gif(80)->url()
```
----------------------
