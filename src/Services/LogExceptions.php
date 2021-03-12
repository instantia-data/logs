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
    
    public function log(FlattenException $e)
    {
        if(strpos($e->getClass(), 'AuthenticationException') !== false){
            return $this->authentication();
        }
        if(strpos($e->getClass(), 'ValidationException') !== false){
            return $this->validation();
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
        info('Mode: ' . php_sapi_name() . ' has Unauthenticated exception @IP ' . request()->ip() . ' in ' . request()->server('HTTP_USER_AGENT'));
        return true;
    }
    
    public function validation()
    {
        info('Mode: ' . php_sapi_name() . ' has Validation error @IP ' . request()->ip() . ' in ' . request()->server('HTTP_USER_AGENT'));
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
        //try {

            $handler = new SymfonyExceptionHandler();

            $html = $handler->getHtml($e);
            $mailable = new ExceptionMail($html);
            $mailable->with('error_class', $e->getClass());
            $mailable->with('error_message', $e->getMessage());
            $mailable->with('error_file', $e->getFile());
            $mailable->with('error_line', $e->getLine());
            $mailable->with('ip', request()->ip());

            Mail::to(config('logging.loggin_email'))->send($mailable);
        //} catch (Exception $ex) {
            //info('email sending failed');
            //self::get()->writeLog($e);
            //return false;
        //}
    }
    
    public function writeLog(FlattenException $e)
    {
        info('Mode: ' . php_sapi_name());
        info('Error class: ' . $e->getClass());
        info('Error message: ' . $e->getMessage());
        info('Error file: ' . $e->getFile());
        info('Error line: ' . $e->getLine());
        info('IP: ' . request()->ip());
        info(request()->ajax());
    }
}
