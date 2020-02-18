<?php

namespace Logs\Services;

use Logs\Services\LogEntryService;

/**
 *
 * @author luispinto
 */
trait UserLog
{
    
    protected static $useragent = null;

    public static function logRegister($user)
    {
        $service = LogEntryService::get();
        if($user == null){
            self::$useragent = $service->register();
        }elseif(session()->has('useragent')){
            self::$useragent = session('useragent');
            session(['useragent' => self::$useragent]);
        }else{
            self::$useragent = $service->setUser($user);
            session(['useragent' => self::$useragent]);
        }
    }
    
    
    /**
     * 
     * @return StdClass
     */
    public function useragent()
    {
        return self::$useragent;
    }

}
