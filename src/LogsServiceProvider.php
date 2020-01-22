<?php

namespace Logs;

use Illuminate\Support\ServiceProvider;

class LogsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/logs.php', 'logs');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        /**
         * Migrations
         */
        $this->loadMigrationsFrom(__DIR__.'/../database');
        
    }
}
