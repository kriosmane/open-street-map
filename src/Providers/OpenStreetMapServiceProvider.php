<?php

namespace Kriosmane\OpenStreetMap\Providers;

use Illuminate\Support\ServiceProvider;
use Kriosmane\OpenStreetMap\OpenStreetMap;

class OpenStreetMapServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        /**
         *  Publish the configuration file (tag: config)
         */
        $this->publishes([
            __DIR__.'/../../config/open-street-map.php' => config_path('open-street-map.php'),
        ], 'config');
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        // Merge the package configuration file with the application's configuration
        $this->mergeConfigFrom(__DIR__.'/../../config/open-street-map.php', 'open-street-map');

        // Registra la classe nel Service Container
        $this->app->singleton(OpenStreetMap::class, function () {
            return new OpenStreetMap(config('open-street-map'));
        });
    }
}
