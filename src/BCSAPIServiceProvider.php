<?php

namespace Bcsapi;

use Illuminate\Support\ServiceProvider;

class BCSAPIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->singleton('BCSApi',function(){

            return new Loader();

        });

         // Allow config without publishing
         $this->mergeConfigFrom(
           __DIR__ . '/../config/bcsapi.php', 'bcsapi'
         );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/bcsapi.php' => config_path('bcsapi.php'),
        ], 'config');
    }
}
