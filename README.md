
Laravel Glide In a Box
============  

[![Latest Stable Version](https://poser.pugx.org/ampedweb/laravel-glide-in-a-box/v)](//packagist.org/packages/ampedweb/laravel-glide-in-a-box) [![License](https://poser.pugx.org/ampedweb/laravel-glide-in-a-box/license)](//packagist.org/packages/ampedweb/laravel-glide-in-a-box) ![Build](https://ci.gorle.co.uk/job/laravel-glide-in-a-box/job/master/badge/icon)

Out of the box solution for [Glide PHP](https://glide.thephpleague.com/) for Laravel

Requirements
------------  

* PHP >= 7.3 with the following extensions:
  * Exif
  * GD  **or** ImageMagick
* league/glide-laravel": "^1.0",

Features
--------  

* Automatically signed urls when using the `glide_url()` helper  function.
* A fluent interface for all glide image api see here: [https://glide.thephpleague.com](https://glide.thephpleague.com/1.0/api/quick-reference/)



Installation
============  

```
composer require ampedweb/laravel-glide-in-a-box
```

Publish the config file:

```bash
php artisan vendor:publish --tag=glideinabox  
```

Basic Usage
============  

The base url "out of the box" for all glide image url requests is "/img/".  You can adjust this in the glideinabox.php config file once you have published it.


Using the `glide_url()` helper function should make building your image urls simple.

An example using a preset as a base and then making a few alterations using the fluent methods:

```php
glide_url($pathToYourImageFile)->preset('medium')->filter('sepia')->url();
```

There are also predefined constants if you prefer using those rather than strings, e.g:

```php
use AmpedWeb\GlideInABox\Interfaces\Filter;

glide_url($pathToYourImageFile)->preset('medium')->filter(Filter::SEPIA)->url();
```

You can also build a completely custom image with no preset.
Below is a 200x100 px cropped webp image at 50% quality:

```php
use AmpedWeb\GlideInABox\Interfaces\Fit;

glide_url($pathToYourImageFile)->size(200,100)->fit(Fit::CROP)->webp(50)->url();
```
Always remember to call the `->url()` method when you are done configuring your image.

Extension
============  
If you would like to use your own image controller but still use the base functionality from the package then you will need to extend:

```php
AmpedWeb\GlideInABox\Controller\GlideImageController;
```

Running Tests:
--------  

```bash
php vendor/bin/phpunit
```

