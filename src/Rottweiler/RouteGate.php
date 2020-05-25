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
        $suspicious_routes = include(database_path('utils/suspicious_routes.php'));
        foreach ($suspicious_routes as $part) {
            if (strpos($url, $part) !== false) {
                fwrite(fopen(storage_path('logs/ban_ip.txt'), 'w'), request()->ip() . "\n");
                return false;
            }
        }


        return true;
    }
    
}
