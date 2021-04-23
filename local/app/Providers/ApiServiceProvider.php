<?php

namespace App\Providers;

use App\Classes\WebServerResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('WebServerResponse', function () {
            return new WebServerResponse; //Add the proper namespace at the top
        });
    }
}
