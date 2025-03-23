<?php

namespace AmpedWeb\GlideInABox\Providers;

use AmpedWeb\GlideUrl\FluentUrlBuilder;
use Illuminate\Contracts\Filesystem\Filesystem;
use AmpedWeb\GlideInABox\Response\ResponseFactory;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem as LeagueFilesSystem;
use League\Flysystem\FilesystemAdapter;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Glide\Server;
use League\Glide\ServerFactory;
use League\Glide\Urls\UrlBuilder;
use League\Glide\Urls\UrlBuilderFactory;

class GlideServerServiceProvider extends ServiceProvider implements DeferrableProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../config/glideinabox.php' => config_path('glideinabox.php'),
                ],
                'glideinabox'
            );
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        /**
         * Bind the FluentUrlBuilder utility class
         */

        $this->app->singleton(
            UrlBuilder::class,
            function ($app) {
                return UrlBuilderFactory::create(
                    '/' . config('glideinabox.base_url') . '/',
                    config('glideinabox.signature_key')
                );
            }
        );

        $this->app->bind(
            FluentUrlBuilder::class,
            function ($app) {
                return new FluentUrlBuilder($app->make(UrlBuilder::class));
            }
        );

        $this->app->singleton(
            Server::class,
            function ($app) {
                $sourceFileSystem = new LeagueFilesSystem(
                    new LocalFilesystemAdapter(config('glideinabox.source', public_path('storage')))
                );

                $serverConfig = [
                    'response' => $app->makeWith(
                        ResponseFactory::class,
                        ['request' => app('request')]
                    ),
                    'source' => $sourceFileSystem,
                    'cache' => $app->make(Filesystem::class)->getDriver(),
                    'cache_path_prefix' => config('glideinabox.cache_path_prefix', '.cache'),
                    'base_url' => config('glideinabox.base_url', 'img'),
                    'defaults' => config('glideinabox.defaults', []),
                    'presets' => config('glideinabox.presets', []),
                    'driver' => config('glideinabox.driver', 'gd'),
                    'group_cache_in_folders' => config('glideinabox.group_cache_in_folders', true),
                    'max_image_size' => config('glideinabox.max_image_size', null),
                ];

                $watermarkFilesystemPath = config('glideinabox.watermarks', null);
                if ($watermarkFilesystemPath !== null) {
                    if ($watermarkFilesystemPath instanceof FilesystemAdapter) {
                        $serverConfig['watermarks'] = new LeagueFilesSystem($watermarkFilesystemPath);
                    } else {
                        $serverConfig['watermarks'] = new LeagueFilesSystem(new LocalFilesystemAdapter($watermarkFilesystemPath));
                    }
                    $serverConfig['watermarks_path_prefix'] = config(
                        'glideinabox.watermarks_path_prefix',
                        '.watermarks'
                    );
                }

                return ServerFactory::create($serverConfig);
            }
        );


    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Server::class, FluentUrlBuilder::class, UrlBuilder::class];
    }
}
