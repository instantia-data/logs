# Logs
User management, login, register, password functions
## Setup
### composer
/composer.json
```
"require": {
        "instantia/logs": ">=1.0"
    },
"repositories": [
        {"type": "vcs", "url": "https://instantia-data@bitbucket.org/instantia-data/logs.git"}
    ]
```
### Register service provider
/config/app.php
```
'providers' => [   
        /*
         * Instantia Package Service Providers...
         */
		 ###
        Logs\LogsServiceProvider::class,
		###
    ],
```
before
```
App\Providers\RouteServiceProvider::class,
```
### Publish files
```
php artisan krud:publish logs

```
### RouteServiceProvider
/app/Providers/RouteServiceProvider.php
```
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
		###
        $this->mapLogsRoutes();
    }
    /**
     * Define the  routes for logs package.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapLogsRoutes()
    {
        Route::namespace($this->namespace)
             ->group(base_path('routes/logs.php'));
    }
```