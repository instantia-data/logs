<?php

namespace Logs\Http\ViewComposer;

use Illuminate\View\View;

/**
 * Description of LanguageComposer
 *
 * @author luispinto
 */
class LogsComposer
{
    /**
     * Share data along views
     * @param View $view
     */
    public function compose(View $view)
    {
        $service = \Logs\Services\LogsService::get();
        $logss = $service->getLogss();
        $view->with('logss', $logss);
    }
    

}
