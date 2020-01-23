<?php

namespace Logs\Services;

use Mail;
use Exception;
use Logs\Mail\ExceptionMail;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;

/**
 * Description of LogExceptions
 *
 * @author luispinto
 */
class LogExceptions
{
    
    public static function log(FlattenException $e)
    {
        if(strpos($e->getClass(), 'AuthenticationException') !== false){
            return self::get()->authentication();
        }
        return false;
    }
    
    /**
     * Get a container for LogExceptions
     * 
     * @return \Policy\Services\LogExceptions
     */
    public static function get()
    {
        return new LogExceptions();
    }
    
    public function __construct(){}

    
    public function authentication()
    {
        info('Mode: ' . php_sapi_name());
        info('Unauthenticated @IP ' . request()->ip() . ' in ' . request()->server('HTTP_USER_AGENT'));
        return true;
    }
    
    
    /**
     * Sends an email to the developer about the exception.
     *
     * @param  \Exception  $e
     * @return void
     */
    public static function email(FlattenException $e)
    {
        info('try email sending');
        try {

            $handler = new SymfonyExceptionHandler();

            $html = $handler->getHtml($e);
            $mailable = new ExceptionMail($html);
            $mailable->with('error_class', $e->getClass());
            $mailable->with('error_message', $e->getMessage());
            $mailable->with('error_file', $e->getFile());
            $mailable->with('error_line', $e->getLine());
            $mailable->with('ip', request()->ip());

            Mail::to(config('logging.loggin_email'))->send($mailable);
        } catch (Exception $ex) {
            info('email sending failed');
            return false;
        }
    }
}
