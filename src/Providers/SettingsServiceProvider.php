<?php

namespace Kodeeo\Settings\Providers;


use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../Migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
