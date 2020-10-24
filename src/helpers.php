<?php

use AmpedWeb\GlideInABox\Util\GlideUrl;

if (!function_exists('glide_url')) {

    function glide_url($path)
    {
        return (new GlideUrl())->setPath($path);
    }

}