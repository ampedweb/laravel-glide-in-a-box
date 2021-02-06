Laravel Glide In a Box
============

[![Latest Stable Version](https://poser.pugx.org/ampedweb/laravel-glide-in-a-box/v)](//packagist.org/packages/ampedweb/laravel-glide-in-a-box)
[![composer.lock](https://poser.pugx.org/ampedweb/laravel-glide-in-a-box/composerlock)](//packagist.org/packages/ampedweb/laravel-glide-in-a-box)
[![License](https://poser.pugx.org/ampedweb/laravel-glide-in-a-box/license)](//packagist.org/packages/ampedweb/laravel-glide-in-a-box)

Out of the box solution for Glide PHP for Laravel

Requirements
------------

* PHP >= 7.3 with the following extensions:
  * Exif
  * GD
* league/glide-laravel": "^1.0",

Features
--------

* Automatically signed urls when using the glide url Laravel helper
* Fluent interface for all of glide image api see here: [https://glide.thephpleague.com/1.0/api/quick-reference/][See here: http://glide.thephpleague.com]


Installation
============

    composer require ampedweb/laravel-glide-in-a-box

Publish the config file:

    php artisan vendor:publish --tag=glideinabox


Extension
============
If you would like to use your own image controller but still use the base functionality from the package then you will need to 
extend:

    AmpedWeb\GlideInABox\Controller\GlideImageController;


Running Tests:
--------

    php vendor/bin/phpunit


[See here: http://glide.thephpleague.com]: https://glide.thephpleague.com/1.0/api/quick-reference/