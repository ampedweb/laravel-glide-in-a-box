<?php

namespace AmpedWeb\GlideInABox\Providers;

use AmpedWeb\GlideInABox\Services\GlideSignatureValidationService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use League\Glide\Signatures\Signature;

class GlideSignatureValidationServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    public function register()
    {


        $this->app->singleton(GlideSignatureValidationService::class,function ($app) {
            return new GlideSignatureValidationService($this->app->make(Signature::class));
        });


    }

    public function provides()
    {
        return [GlideSignatureValidationService::class];
    }
}
