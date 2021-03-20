<?php

use AmpedWeb\GlideInABox\Util\GlideUrl;

if (!function_exists('glide_url')) {

    /**
     * @param null $path
     *
     * @return GlideUrl|string
     */
    function glide_url($path = null)
    {
        if ($path === null) {
            return '';
        }

        return (new GlideUrl())->setPath($path);
    }

}