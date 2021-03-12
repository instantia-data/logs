<?php

namespace Logs\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExceptionMail extends Mailable
{
    use Queueable, SerializesModels;
    use \App\Helpers\MailTools;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        if(app()->runningInConsole()){
            return $this->consoleException();
        }
        $uri = (null === request()->route())? $_SERVER['REQUEST_URI']: request()->route()->uri;
        $subject = 'Exception occured @' . env('APP_NAME') . '-' . $uri . ' on ' . date('Y-m-d H:i:s');
        info('EXCEPTION EMAIL: ' . $subject);
        
        return $this->view('logs::mail.exception')->from(config('mail.from.address'), env('APP_NAME'))
                //->from($email)
                ->subject('Exception occured @' . env('APP_NAME') . '-' . $uri . ' on ' . date('Y-m-d H:i:s'))
                ->with('url', request()->url() . ' -> ' . $uri)
                ->with('inputs', http_build_query(request()->input(), '', '<br />'))
                ->with('subject', $subject)
                ->with('info', $this->setInfo())
                ->with('content', $this->content);
    }
    
    private function consoleException()
    {
        $subject = 'Exception occured @' . env('APP_NAME') . '- console on ' . date('Y-m-d H:i:s');
        return $this->view('logs::mail.exception')->from(config('mail.from.address'), env('APP_NAME'))
                //->from($email)
                ->subject($subject)
                ->with('url', env('APP_URL'))
                ->with('inputs', [])
                ->with('subject', $subject)
                ->with('content', $this->content);
    }
}
