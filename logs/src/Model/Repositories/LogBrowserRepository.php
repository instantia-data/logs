<?php

namespace Logs\Model\Repositories;

use Logs\Model\Entities\LogBrowser;

class LogBrowserRepository
{
    
    
    /**
     * @var $model
     */
    private $model;
    
    /**
     * EloquentPackage constructor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function __construct() {
        $this->model = new LogBrowser();
    }
    
    /**
     * 
     * @param string $alias
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function start($alias = null)
    {
        if($alias == null){
            $alias = LogBrowser::TABLE_NAME;
        }
        return LogBrowser::from(LogBrowser::TABLE_NAME . ' AS ' .$alias)->select($alias . '.*');
    }
    
    /**
     * 
     * @return \Logs\Model\Repositories\LogBrowserRepository
     */
    public static function get()
    {
        return new LogBrowserRepository();
    }

}
