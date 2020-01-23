# Logs
Generate logs to database on model events - create, update, delete
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
## To use in models
```
    /**
     * Event observers
     * @var type 
     */
    protected $dispatchesEvents = [
        'saved' => ModelObserver::class,
        'created' => ModelObserver::class,
        'updated' => ModelObserver::class,
        'deleted' => ModelObserver::class,

    ];
```
## ModelObserver example
```
<?php

namespace App\Observers;

use App\Model\Entities\Model;
use Logs\Services\LogEntryService;

class ModelObserver
{
    
    private $service;

    /**
     * Create a new class instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new LogEntryService();
    }
    
    /**
     * Handle the table "created" event.
     *
     * @param  \App\Model\Entities\Model  $model
     * @return void
     */
    public function created(Model $model)
    {
        $this->service->logCreated($model);
    }

    /**
     * Handle the table "updated" event.
     *
     * @param  \App\Model\Entities\Model  $model
     * @return void
     */
    public function updated(Model $model)
    {
        $this->service->logUpdate($model);
    }

    /**
     * Handle the table "deleted" event.
     *
     * @param  \App\Model\Entities\Model  $model
     * @return void
     */
    public function deleted(Model $model)
    {
        $this->service->logDeleted($model);
    }

    /**
     * Handle the table "restored" event.
     *
     * @param  \App\Model\Entities\Model  $model
     * @return void
     */
    public function restored(Model $model)
    {
        //
    }

    /**
     * Handle the table "force deleted" event.
     *
     * @param  \App\Model\Entities\Model  $model
     * @return void
     */
    public function forceDeleted(Model $model)
    {
        //
    }
}

```