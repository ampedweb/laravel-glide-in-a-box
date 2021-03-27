---
layout: page
title: Size
parent: Glide URL Helper (Image API)
permalink: /glide-url-helper/size
nav_order: 10
---
# Size
{: .no_toc }

See original Glide PHP crop docs [here](https://glide.thephpleague.com/2.0/api/size/)

All descriptions are directly quoted from the above docs.

---------------------
## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}
---

## Width

Sets the width of the image, in pixels.

Width of image is 250 pixels

```php 
glide_url('/path/to/your_amazing_image.jpeg')->width(250)->url()
```
----------------------
## Height

Sets the height of the image, in pixels.

Height of image is 250 pixels

```php 
glide_url('/path/to/your_amazing_image.jpeg')->height(250)->url()
```
----------------------
## Width & Height

Sets the width & height of the image at the same time.

Width of image 500 & Height of image is 250  pixels

```php 
glide_url('/path/to/your_amazing_image.jpeg')->size(500,250)->url()
```

## Fit

Sets how the image is fitted to its target dimensions.

Width of image 250 & Height of image is 250  pixels with a crop

```php 
glide_url('/path/to/your_amazing_image.jpeg')->size(250,250)->fit('crop')->url()
```
#### Fit Constants
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