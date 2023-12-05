---
layout: page 
title: Watermarks 
parent: Glide URL Helper (Image API)
permalink: /glide-url-helper/watermarks 
nav_order: 11
---

# Watermarks

{: .no_toc }

See original Glide PHP watermarks docs [here](https://glide.thephpleague.com/2.0/api/watermarks/)

All descriptions are directly quoted from the above docs.

---------------------

## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}
---

## Path

Adds a watermark to the image. Must be a path to an image in the watermarks file system, as configured in your server.

```php 
glide_url('/path/to/your_amazing_image.jpeg')->mark('your_amazing_watermark.png')->url()
```

----------------------

## Mark Width

Sets the width of the watermark in pixels, or
using [relative dimensions](https://glide.thephpleague.com/2.0/api/relative-dimensions/).

```php 
glide_url('/path/to/your_amazing_image.jpeg')->mark('your_amazing_watermark.png')->markWidth(100)->url()
```

----------------------

## Mark Height

Sets the height of the watermark in pixels, or
using [relative dimensions](https://glide.thephpleague.com/2.0/api/relative-dimensions/).

```php 
glide_url('/path/to/your_amazing_image.jpeg')->mark('your_amazing_watermark.png')->markHeight(100)->url()
```

----------------------

## Mark Fit

Sets how the watermark is fitted to its target dimensions.

```php 
glide_url('/path/to/your_amazing_image.jpeg')->mark('your_amazing_watermark.png')->markFit('crop')->url()
//OR
glide_url('/path/to/your_amazing_image.jpeg')->mark('your_amazing_watermark.png')->markFit(Fit::CROP)->url()
```

#### Mark Fit Constants

```php 

/**
 * @var string Default.  Resize the image to fit within the width and height boundaries without cropping,
 * distorting or altering the aspect ratio.
 */  
 Fit::CONTAIN //same as "contain"

/**
 * Resizes the image to fill the width and height boundaries and crops any excess image data. The
 * resulting image will match the width and height constraints without distorting the image. See the crop page
 * for more information.
 */    
Fit::CROP //same as "crop"


/**
 * Resizes the image to fit within the width and height boundaries without cropping or distorting the
 * image, and the remaining space is filled with the background color. The resulting image will match the
 * constraining dimensions.
 */   
Fit::FILL 
    

/**
 * Resizes the image to fit within the width and height boundaries without cropping, distorting or
 * altering the aspect ratio, and will also not increase the size of the image if it is smaller than the
 * output size.
 */     
Fit::MAX 
    
    
/**
 * Stretches the image to fit the constraining dimensions exactly. The resulting image will fill the
 * dimensions, and will not maintain the aspect ratio of the input image.
 */
Fit::STRETCH
```

## X-offset

Sets how far the watermark is away from the left and right edges of the image. Set in pixels, or
using [relative dimensions](https://glide.thephpleague.com/2.0/api/relative-dimensions/). Ignored if markpos is set to
center.

```php 
glide_url('/path/to/your_amazing_image.jpeg')->mark('your_amazing_watermark.png')->markX(25)->url()
```

----------------------

## Y-offset

Sets how far the watermark is away from the top and bottom edges of the image. Set in pixels, or
using [relative dimensions](https://glide.thephpleague.com/2.0/api/relative-dimensions/). Ignored if markpos is set to
center.

```php 
glide_url('/path/to/your_amazing_image.jpeg')->mark('your_amazing_watermark.png')->markY(25)->url()
```

----------------------

## Padding

Sets how far the watermark is away from edges of the image. Basically a shortcut for using both markx and marky. Set in
pixels, or using [relative dimensions](https://glide.thephpleague.com/2.0/api/relative-dimensions/). Ignored if markpos
is set to center.

```php 
glide_url('/path/to/your_amazing_image.jpeg')->mark('your_amazing_watermark.png')->markPad(25)->url()
```

----------------------

## Position

Sets where the watermark is positioned. Accepts top-left, top, top-right, left, center, right, bottom-left, bottom,
bottom-right. Default is center.

```php 
glide_url('/path/to/your_amazing_image.jpeg')
         ->mark('your_amazing_watermark.png')
         ->markPos('top-left')->url()
//OR
glide_url('/path/to/your_amazing_image.jpeg')
         ->mark('your_amazing_watermark.png')
         ->markPos(Position::TOP_LEFT)->url()
```

----------------------

#### Position Constants

```php
namespace AmpedWeb\GlideUrl\Interfaces\Position;

Position::TOP_LEFT // same as "top-left"
Position::TOP // same as "top"
Position::TOP_RIGHT  // same as "top-right"
Position::LEFT // same as "left"
Position::CENTER // same as "center"
Position::RIGHT // same as "right"
Position::BOTTOM_LEFT // same as "bottom-left"
Position::BOTTOM // same as "bottom"
Position::BOTTOM_RIGHT // same as "bottom-right"
```
----------------------

## Alpha

Sets the opacity of the watermark. Use values between 0 and 100, where 100 is fully opaque, and 0 is fully transparent.
The default value is 100.

Watermark is 50% Transparent

```php 
glide_url('/path/to/your_amazing_image.jpeg')->mark('your_amazing_watermark.png')->markAlpha(50)->url()
```

----------------------