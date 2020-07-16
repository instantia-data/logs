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
    const DATA_TOKEN = 'token';
    

    public static function register()
    {
        
        if (session()->get('visit') == null) {
            
            self::$data = [
                self::DATA_CREATED_AT =>time(),
                self::DATA_UPDATED_AT => time(),
                self::DATA_IP => request()->ip(),
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
    
    public static function getToken()
    {
        if (isset(self::$data[self::DATA_TOKEN])) {
            return self::$data[self::DATA_TOKEN];
        }
        $token = bcrypt(request()->ip() . time());
        self::$data[self::DATA_TOKEN] = $token;
        session(['visit' => self::$data]);
        return $token;
    }
    
    public static function resetToken()
    {
        if (isset(self::$data[self::DATA_TOKEN])) {
            unset(self::$data[self::DATA_TOKEN]);
        }
        session(['visit' => self::$data]);
    }
    
    /**
     * Get session 'visit' as array or one of the indexes
     * @param string $index
     * @return mixed
     */
    public static function getVisit($index = null)
    {
        if($index != null){
            return self::$data[$index];
        }
        return session()->get('visit');
    }

}
