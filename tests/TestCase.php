<?php

namespace AmpedWeb\GlideInABox\Tests;

use AmpedWeb\GlideInABox\Providers\GlideInABoxRoutesProvider;
use AmpedWeb\GlideInABox\Providers\GlideServerServiceProvider;
use AmpedWeb\GlideInABox\Providers\GlideSignatureValidationServiceProvider;
use AmpedWeb\GlideInABox\Providers\SignatureServiceProvider;
use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        /** @var Router $router */
        $router = $this->app->get('router');

        Artisan::call('storage:link');
        // additional setup
        //Set our glideinabox config
        Config::set(
            "glideinabox",
            [
                'signature_key'     => '9e83e05bbf9b5db17ac0deec3b7ce6cba983f6dc50531c7a919f28d5fb3696c3',
                'cache_path_prefix' => '.cache',
                'source'            => public_path('storage'),
                'base_url'          => '',
                'max_image_size'    => 50 * 50,
                'presets'           => [
                    'small'  => [
                        'w'   => 200,
                        'h'   => 200,
                        'fit' => 'crop',
                    ],
                    'medium' => [
                        'w'   => 600,
                        'h'   => 400,
                        'fit' => 'crop',
                    ]
                ]
            ]
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

    /**
     * Setup logging
     */
    protected function getEnvironmentSetUp($app)
    {
    }
}
