<?php

namespace Logs\Helpers;

use Symfony\Component\Debug\Exception\FlattenException;
use AntiBot\Model\Entities\LogBot;
use Logs\Services\LogExceptions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

/**
 *
 * @author luispinto
 */
trait ExceptionHandlerSupport 
{
    
    protected $api = false;
    
    protected $flatten;
    
    protected $ban = false;


    protected function setReporting(Throwable $exception) 
    {
        
        $this->api = \App\Http\Middleware\CheckToken::$api;
        if ($this->api == true) {
            info('api reporting');
        }
        $this->flatten = FlattenException::createFromThrowable($exception);
        
        
        //log_var($this->flatten->getMessage());
        if(strpos($this->flatten->getClass(), 'NotFoundHttpException') !== false){
            if(\Logs\Rottweiler\RouteGate::validError(request()->url()) == false){
                $this->registerBadBot(request());
                LogExceptions::email($this->flatten);
                $this->ban = true;
            }
        }
        
        if ($this->isBotThrottle($exception) == true) {
            $this->ban = true;
        }
        
        LogExceptions::get()->writeLog($this->flatten);
    }
    
    
    protected function emailing() 
    {
        if(env('LOG_EXCEPTION') != 'email' || strpos(php_sapi_name(), 'cli') !== false){
            return false;
        }
        if (strpos($this->flatten->getClass(), 'TokenMismatchException') === false 
                && strpos($this->flatten->getClass(), 'OAuthServerException') === false 
                && strpos($this->flatten->getClass(), 'ValidationException') === false 
                && strpos($this->flatten->getClass(), 'AuthenticationException') === false
                && strpos($this->flatten->getClass(), 'ThrottleRequestsException') === false) {
            if(LogExceptions::email($this->flatten) != false){
                
                return true;
            } // sends an email
        }
        return false;
    }
    
    
    protected function renderForApi(Throwable $exception)
    {
        info('error in api');
        
        $message = $this->flatten->getMessage();
        $code = 500;
        
        if ($this->isHttpException($exception)) {
            $message = 'Not Found: ' . request_uri();
            $code = 404;
        }
        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
            $message = 'Validation Token was expired. Please try again';
        }
        if ($exception instanceof \Illuminate\Http\Exceptions\ThrottleRequestsException) {
            $message = 'Too many attempts';
        }
        
        return response()->json([
                'message' => $message,
                'file'=>$this->flatten->getFile() . ' :line ' . $this->flatten->getLine(),
                'success'=>0], $code);
    }
    
    
    protected function urlBan() 
    {
        return 'http://x' . Str::random(10) . '.' . Str::random(3);
    }
    
    protected function registerBadBot(Request $request) 
    {
        LogBot::updateOrCreate([
            'ip'=>$request->ip(), 
            'name'=> $request->server('HTTP_USER_AGENT')
        ], [
            'blocked'=>1
        ]);
    }
    
    
    private function isBotThrottle($exception) 
    {
        if ($exception instanceof \Illuminate\Http\Exceptions\ThrottleRequestsException) {
            info('Too Many Attempts');
            $bot = LogBot::where('ip', request()->ip())->where('blocked', 1)->first();
            if(null !== $bot){
                return true;
            }
        }
        
        return false;
    }
    
    
}
