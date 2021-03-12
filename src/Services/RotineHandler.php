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
        
        $str = 'Url-Route ' . request()->url() . ' (' . request()->route()->getName() . ')';
        
        if(is_string(request()->route()->action['uses'])){
            $str .= "\n Controller: " . request()->route()->action['uses'];
        }
        info($str);
        
    }
}
