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
    
    const DATA_SESSION_ID = 'current';
    const DATA_CREATED_AT = 'created';
    const DATA_UPDATED_AT = 'time';
    const DATA_IP = 'ip';
    const DATA_ID = 'id';
    

    public static function register()
    {
        
        if (session()->get('visit') == null) {
            
            self::$data = [
                self::DATA_CREATED_AT =>time(),
                self::DATA_UPDATED_AT => time(),
                self::DATA_IP => request()->ip(),
                self::DATA_ID => bcrypt(request()->ip() . time()),
                self::DATA_SESSION_ID=>session()->getId()
            ];
        }else{
            self::$data = session()->get('visit');
            self::$data[self::DATA_SESSION_ID] = session()->getId();
            self::$data[self::DATA_UPDATED_AT] = time();
            self::$data[self::DATA_IP] = request()->ip();
        }
        session(['visit' => self::$data]);
    }
    
    
    public static function getVisit()
    {
        return session()->get('visit');
    }

}
