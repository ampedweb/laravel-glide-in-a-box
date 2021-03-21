---
layout: page
title: Adjustments
parent: Glide URL Helper (Image API)
permalink: /glide-url-helper/adjustments
nav_order: 1

---
# Adjustments
{: .no_toc }

See original Glide PHP adjustment docs [here](https://glide.thephpleague.com/1.0/api/adjustments/)

All descriptions in bold italics are directly quoted from the above docs.

---------------------

## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}
---

## Brightness

***Adjusts the image brightness. Use values between -100 and +100, where 0 represents no change.***


Get your image at 40% brighness:
```php 
glide_url('/path/to/your_amazing_image.jpeg')->bri(40)->url()
//OR
glide_url('/path/to/your_amazing_image.jpeg')->brighness(40)->url()

```
----------------------
## Contrast

***Adjusts the image contrast. Use values between -100 and +100, where 0 represents no change.***


Get your image at 40% contrast:
```php 
glide_url('/path/to/your_amazing_image.jpeg')->con(40)->url()
//OR
glide_url('/path/to/your_amazing_image.jpeg')->contrast(40)->url()

```
----------------------
## Gamma

***Adjusts the image gamma. Use values between 0.1 and 9.99.***


Get your image at 1.5 gamma:

```php 
glide_url('/path/to/your_amazing_image.jpeg')->gam(1.5)->url()
//OR
glide_url('/path/to/your_amazing_image.jpeg')->gamma(1.5)->url()

```

----------------------
## Sharpen

***Sharpen the image. Use values between 0 and 100.***


Get your image at 15 sharpness:

```php 
glide_url('/path/to/your_amazing_image.jpeg')->sharp(15)->url()
//OR
glide_url('/path/to/your_amazing_image.jpeg')->sharpen(15)->url()

```
