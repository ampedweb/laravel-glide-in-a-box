<?php

namespace AmpedWeb\GlideInABox\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use AmpedWeb\GlideInABox\Providers\GlideServerServiceProvider;
use AmpedWeb\GlideInABox\Providers\GlideSignatureValidationServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class TestCase extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $config = include __DIR__.'/../src/config/glideinabox.php';

        $config['base_url'] = '';
        $config['max_image_size'] = 50 * 50;

        Artisan::call('storage:link');

        Config::set("glideinabox", $config);
    }

    protected function getPackageProviders($app): array
    {
        return [
            GlideServerServiceProvider::class,
            GlideSignatureValidationServiceProvider::class,
        ];
    }
}
