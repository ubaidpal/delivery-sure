<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 25-Apr-16 1:10 PM
 * File Name    : AdminServiceProvider.php
 */

namespace DemeDat\Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function boot() {
        //Loading Routes File
        //echo __DIR__ . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'routes.php'; die;
        if (! $this->app->routesAreCached()) {
            require __DIR__ . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'routes.php';
        }

        //Define the path of views folder
        $this->loadViewsFrom(__DIR__ . '/Views', 'Admin');

        $this->publishes([
            __DIR__.'/migrations' => base_path('database/migrations'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        // TODO: Implement register() method.
        $this->app['Admin'] = $this->app->share(function ($app) {
            return new Admin;
        });
    }
}
