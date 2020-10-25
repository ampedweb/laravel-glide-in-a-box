<?php

namespace AmpedWeb\GlideInABox\Providers;

use AmpedWeb\GlideInABox\Util\GlideUrl;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem as LeagueFilesSystem;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\Server;
use League\Glide\ServerFactory;

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
                'config'
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
         * Bind the GlideUrl utility class
         */
        $this->app->bind(
            GlideUrl::class,
            function ($app) {
                return new GlideUrl();
            }
        );

        $this->app->singleton(
            Server::class,
            function ($app) {


                $sourceFileSystemPath = config('glideinabox.source', public_path('storage'));
                $sourceFileSystem = new LeagueFilesSystem(new Local($sourceFileSystemPath));


                $serverConfig = [
                    'response'               => $app->makeWith(
                        LaravelResponseFactory::class,
                        ['request' => app('request')]
                    ),
                    'source'                 => $sourceFileSystem,
                    'cache'                  => $app->make(Filesystem::class)->getDriver(),
                    'cache_path_prefix'      => config('glideinabox.cache_path_prefix', '.cache'),
                    'base_url'               => config('glideinabox.base_url', 'img'),
                    'defaults'               => config('glideinabox.defaults', []),
                    'presets'                => config('glideinabox.presets', []),
                    'driver'                 => config('glideinabox.driver', 'gd'),
                    'group_cache_in_folders' => config('glideinabox.group_cache_in_folders', true),
                    'max_image_size'         => config('glideinabox.max_image_size', null)
                ];

                $watermarkFilesystemPath = config('glideinabox.watermarks', null);
                if ($watermarkFilesystemPath !== null) {
                    $serverConfig['watermarks'] = new LeagueFilesSystem(new Local($watermarkFilesystemPath));
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
        return [Server::class];
    }
}
