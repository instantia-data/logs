<?php

namespace Logs\Model\Repositories;

use Logs\Model\Entities\LogOperation;

class LogOperationRepository
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
        $this->model = new LogOperation();
    }
    
    /**
     * 
     * @param string $alias
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function start($alias = null)
    {
        if($alias == null){
            $alias = LogOperation::TABLE_NAME;
        }
        return LogOperation::from(LogOperation::TABLE_NAME . ' AS ' .$alias)->select($alias . '.*');
    }
    
    /**
     * 
     * @return \Logs\Model\Repositories\LogOperationRepository
     */
    public static function get()
    {
        return new LogOperationRepository();
    }

}
