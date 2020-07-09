<?php


namespace Logs\Services;

/**
 * Description of RotineHandler
 *
 * @author luispinto
 */
class RotineHandler
{
    
    public static function run()
    {
        if(!defined('EXECUTION_TIME')){
            define('EXECUTION_TIME', microtime(true));
        }
        
        \Logs\Services\Visit::register();
        
        info('Url-Route ' . request()->url() . ' ' . 
                request()->route()->uri . ' (' . 
                request()->route()->getName() . ')');
        if(is_string(request()->route()->action['uses'])){
            info('Controller: ' . request()->route()->action['uses']);
        }
        
    }
}
