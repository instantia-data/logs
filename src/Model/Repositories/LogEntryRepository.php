<?php

namespace Logs\Model\Repositories;

use Logs\Model\Entities\LogEntry;
use Carbon\Carbon;

class LogEntryRepository
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
        $this->model = new LogEntry();
    }
    
    /**
     * 
     * @param string $alias
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function start($alias = null)
    {
        if($alias == null){
            $alias = LogEntry::TABLE_NAME;
        }
        return LogEntry::from(LogEntry::TABLE_NAME . ' AS ' .$alias)->select($alias . '.*');
    }
    
    /**
     * 
     * @return \Logs\Model\Repositories\LogEntryRepository
     */
    public static function get()
    {
        return new LogEntryRepository();
    }
    
    public function getRecentWithoutUser($ip, $browser, $operation)
    {
        return $this->start()
                ->where(LogEntry::FIELD_IP_ID, $ip->id)
                ->where(LogEntry::FIELD_BROWSER_ID, $browser->id)
                ->where(LogEntry::FIELD_OPERATION_ID, $operation->id)
                ->whereNull(LogEntry::FIELD_USER_ID)
                ->where(LogEntry::FIELD_CREATED_AT, '>', Carbon::now()->subMinutes(15)->format('Y-m-d H:i:s'))
                ->first();
        
    }

}
