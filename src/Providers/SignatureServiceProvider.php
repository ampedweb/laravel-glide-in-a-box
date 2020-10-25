<?php

namespace AmpedWeb\GlideInABox\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use League\Glide\Signatures\Signature;

class SignatureServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Signature::class,function ($app) {
            return new Signature(config('glideinabox.signature_key'));
        });
    }

    public function provides()
    {
        return [Signature::class];
    }
}
