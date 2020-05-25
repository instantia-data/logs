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
        $this->mergeConfigFrom(__DIR__.'/../config/vendor.php', 'logs-vendor');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        /**
         * Views
         */
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'logs');
        /**
         * Migrations
         */
        $this->loadMigrationsFrom(__DIR__.'/../database');
        
        /**
         * Suspicious routes array
         */
        $this->publishes([__DIR__.'/../assets/utils/suspicious_routes.php' => database_path('utils/suspicious_routes.php')], 'id-logs-db-force');
        
    }
}
