<?php

namespace Logs\Rottweiler;

/**
 * Description of RouteGate
 *
 * @author luispinto
 */
class RouteGate
{
    
    
    public static function validError($url)
    {
        foreach (self::$suspicious as $part) {
            if (strpos($url, $part) !== false) {
                fwrite(fopen(storage_path('logs/ban_ip.txt'), 'w'), request()->ip() . "\n");
                return false;
            }
        }


        return true;
    }
    
    private static $suspicious = [
        'wp-admin', 'magento', 'wp-login'
    ];
}
