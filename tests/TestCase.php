<?php

namespace AmpedWeb\GlideInABox\Tests;

use AmpedWeb\GlideInABox\Providers\GlideInABoxRoutesProvider;
use AmpedWeb\GlideInABox\Providers\GlideServerServiceProvider;
use AmpedWeb\GlideInABox\Providers\GlideSignatureValidationServiceProvider;
use AmpedWeb\GlideInABox\Providers\SignatureServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use League\Flysystem\Adapter\Local;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $config = include __DIR__.'/../src/config/glideinabox.php';

        $config['base_url'] = '';
        $config['max_image_size'] = 50 * 50;

        Artisan::call('storage:link');
        // additional setup
        //Set our glideinabox config
        Config::set(
            "glideinabox",
            $config
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            GlideServerServiceProvider::class,
            GlideSignatureValidationServiceProvider::class,
            SignatureServiceProvider::class,
            GlideInABoxRoutesProvider::class
        ];
    }
}
