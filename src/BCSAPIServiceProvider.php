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

            return new Loader(config('services.bcsapi.v2.backoffice.url'), config('services.bcsapi.v2.backoffice.key'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
