<?php

namespace Logs\Model\Repositories;

use Logs\Model\Entities\LogIp;

class LogIpRepository
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
        $this->model = new LogIp();
    }
    
    /**
     * 
     * @param string $alias
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function start($alias = null)
    {
        if($alias == null){
            $alias = LogIp::TABLE_NAME;
        }
        return LogIp::from(LogIp::TABLE_NAME . ' AS ' .$alias)->select($alias . '.*');
    }
    
    /**
     * 
     * @return \Logs\Model\Repositories\LogIpRepository
     */
    public static function get()
    {
        return new LogIpRepository();
    }

}
