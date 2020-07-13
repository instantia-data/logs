<?php


namespace Logs\Services;

/**
 * Description of Visit
 *
 * @author luispinto
 */
class Visit
{
    public static $data;

    public static function register()
    {
        
        if (session()->get('visit') == null) {
            
            self::$data = [
                'created'=>time(),
                'time' => time(),
                'ip' => request()->ip(),
                'id' => bcrypt(request()->ip() . time()),
                'current'=>session()->getId()
            ];
        }else{
            self::$data = session()->get('visit');
            self::$data['current'] = session()->getId();
            self::$data['time'] = time();
            self::$data['ip'] = request()->ip();
        }
        session(['visit' => self::$data]);
    }
    
    
    public static function getVisit()
    {
        return session()->get('visit');
    }

}
