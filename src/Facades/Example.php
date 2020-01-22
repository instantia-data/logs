<?php

namespace instantia\Library\Facades;

use Illuminate\Support\Facades\Facade;

class Logs extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Logs';
    }
}
