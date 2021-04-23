<?php

namespace App\Providers;

use App\Classes\HashId;
use Illuminate\Support\ServiceProvider;

class HashIdProvider extends ServiceProvider
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
        $this->app->bind('HashId', function(){
            return new HashId();
        });
    }
}
