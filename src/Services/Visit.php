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
                'time' => time(),
                'ip' => request()->ip(),
                'id' => bcrypt(request()->ip() . time())
            ];
            session(['visit' => self::$data]);
        }
    }

}
