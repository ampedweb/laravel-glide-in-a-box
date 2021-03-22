---
layout: page
title: Crop
parent: Glide URL Helper (Image API)
permalink: /glide-url-helper/crop 
nav_order: 4
---

# Crop
{: .no_toc}

See original Glide PHP crop docs [here](https://glide.thephpleague.com/1.0/api/crop/)

All descriptions in bold italics are directly quoted from the above docs.

---------------------
## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}
---


## Fit

Resizes the image to fill the width and height boundaries and crops any excess image data. The resulting image will
match the width and height constraints without distorting the image.

Standard crop to 100px x 100px.

```php 
glide_url('/path/to/your_amazing_image.jpeg')->crop(100,100)->url()
```
----------------------
### Crop Position

You can also set where the image is cropped by adding a crop position. Accepts crop-top-left, crop-top,
crop-top-right, crop-left, crop-center, crop-right, crop-bottom-left, crop-bottom or crop-bottom-right. Default is
crop-center, and is the same as crop

```php 
glide_url('/path/to/your_amazing_image.jpeg')->cropToPosition(100,100,'crop-top-left')->url()
//OR
glide_url('/path/to/your_amazing_image.jpeg')->cropToPosition(100,100,Crop::TOP_LEFT)->url()
```
#### Position Constants
```php
    Crop::TOP_LEFT // same as "crop-top-left"
    Crop::TOP // same as "top"
    Crop::TOP_RIGHT  // same as "crop-top-right"
    Crop::LEFT // same as "crop-left"
    Crop::CENTER // same as "crop-center"
    Crop::RIGHT // same as "crop-right"
    Crop::BOTTOM_LEFT // same as "crop-bottom-left"
    Crop::BOTTOM // same as "crop-bottom"
    Crop::BOTTOM_RIGHT // same as "crop-bottom-right"
```
----------------------
### Crop Focal Point

In addition to the crop position, you can be more specific about the exact crop position using a focal point. This is
defined using two offset percentages: crop-x%-y%.

### Exact Focal Point
```php 
glide_url('/path/to/your_amazing_image.jpeg')->cropToFocalPoint(25,75)->url()
```

### Exact Focal Point with Zoom
You may also choose to zoom into your focal point by providing a third value: a float between 1 and 100. 
Each full step is the equivalent of a 100% zoom. (eg. x%-y%-2 is the equivalent of viewing the image at 200%). The suggested range is 1-10.
```php 
glide_url('/path/to/your_amazing_image.jpeg')->cropToFocalPoint(25,75,2)->url()
```
----------------------
### Crop To Bounding Box
Crops the image to specific dimensions prior to any other resize operations. Required format: width,height,x,y.
```php 
glide_url('/path/to/your_amazing_image.jpeg')->cropToBoundingBox(100,100,915,155)->url()
```