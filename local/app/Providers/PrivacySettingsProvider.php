<?php

namespace App\Providers;

use App\Classes\PrivacySettings;
use Illuminate\Support\ServiceProvider;

class PrivacySettingsProvider extends ServiceProvider
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
        $this->app->bind('Privacy', function(){
            return new PrivacySettings();
        });
    }
}
