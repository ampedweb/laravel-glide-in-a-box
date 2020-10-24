<?php

namespace AmpedWeb\GlideInABox\Providers;

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

        $this->registerRoutes();
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../config/glideinabox.php' => config_path('glideinabox.php'),
                ],
                'config'
            );
        }
    }

    protected function registerRoutes()
    {
        Route::group(
            $this->routeConfiguration(),
            function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            }
        );
    }

    protected function routeConfiguration()
    {
        return [
            'prefix'     => config('glideinabox.route_prefix'),
            'middleware' => config('glideinabox.route_middleware'),
        ];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(
            Server::class,
            function ($app) {

                $leagueFileSystem = new LeagueFilesSystem(new Local(public_path('storage')));

                $this->app->instance(LeagueFilesSystem::class, $leagueFileSystem);

                return ServerFactory::create(
                    [
                        'response'          => $app->makeWith(
                            LaravelResponseFactory::class,
                            ['request' => app('request')]
                        ),
                        'source'            => $app->make(LeagueFilesSystem::class),
                        'cache'             => $app->make(Filesystem::class)->getDriver(),
                        'cache_path_prefix' => config('glideinabox.cache_path_prefix'),
                        'base_url'          => config('glideinabox.base_url'),
                    ]
                );
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
