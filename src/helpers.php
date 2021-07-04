<?php

use AmpedWeb\GlideUrl\FluentUrlBuilder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
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


        $parsedPathClosure = function($path) {
            $parsedPath = $path;
            if (Str::startsWith($parsedPath, '/storage/')) {
                $parsedPath = Str::replaceFirst('/storage/', '', $parsedPath);
            }
            return Str::of($parsedPath)->replace('\\', '/');
        };

        $urlClosure = function($url) {
          return url($url);
        };


        return (new FluentUrlBuilder(App::make(UrlBuilder::class)))
                ->setPath($path)
                ->setPathClosure($parsedPathClosure)
                ->setUrlClosure($urlClosure);
    }

}