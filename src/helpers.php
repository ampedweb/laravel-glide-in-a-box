<?php

use Illuminate\Support\Str;
use League\Glide\Urls\UrlBuilderFactory;

if (! function_exists('glide_image_url')) {

    function glide_image_url($path,array $params = []) {


        if(Str::startsWith($path,'/storage/')) {
            $path = Str::replaceFirst('/storage/','',$path);
        }

        $path = Str::of($path)->replace('\\','/');

        $urlBuilder = UrlBuilderFactory::create('/'.config('app.glide_base_img_prefix').'/', config('app.glide_image_signature_key'));

        return url($urlBuilder->getUrl($path, $params));

    }

}