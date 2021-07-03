<?php

use AmpedWeb\GlideInABox\Util\GlideUrl;
use AmpedWeb\GlideUrl\FluentUrlBuilder;
use Illuminate\Support\Facades\App;
use League\Glide\Urls\UrlBuilder;

if (!function_exists('glide_url')) {

    /**
     * @param null $path
     *
     * @return FluentUrlBuilder|string
     */
    function glide_url($path = null)
    {
        if ($path === null) {
            return '';
        }
        return (new FluentUrlBuilder(App::make(UrlBuilder::class)))->setPath($path);
    }

}