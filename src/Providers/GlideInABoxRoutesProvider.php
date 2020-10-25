<?php


namespace AmpedWeb\GlideInABox\Providers;


use Illuminate\Support\ServiceProvider;

class GlideInABoxRoutesProvider extends ServiceProvider
{
    public function boot() {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }
}