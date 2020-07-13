<?php

namespace Logs\Services;

use Logs\Model\Repositories\LogEntryRepository;
use Logs\Model\Entities\LogOperation;
use Logs\Model\Entities\LogBrowser;
use Logs\Model\Entities\LogEntry;
use Logs\Model\Entities\LogIp;
use Logs\Services\Visit;

/**
 * Description of LogEntryService
 *
 * @author luispinto
 */
class LogEntryService
{

    use \Logs\Helpers\LogModel;

    protected $repository;

    /**
     * 
     */
    public function __construct()
    {

        $this->repository = new LogEntryRepository();
        if (!is_dir(storage_path('logs/entries/'))) {
            mkdir(storage_path('logs/entries/'));
        }
    }

    /**
     * Get a container for LogEntryService
     * 
     * @return \Policy\Services\LogEntryService
     */
    public static function get()
    {
        return new LogEntryService();
    }
    

    /**
     * Register registered user to logs
     * @see \Logs\Services\UserLog called by \App\User
     * @return type
     */
    public function register()
    {

        $ip = LogIp::firstOrCreate(['ip' => request()->ip()]);
        $browser = LogBrowser::firstOrCreate(['browser_info' => request()->server('HTTP_USER_AGENT')]);
        $operation = LogOperation::firstOrCreate(['name' => 'register']);

        $entry = $this->repository->getRecentWithoutUser($ip, $browser, $operation);
        if ($entry == null) {
            $entry = new LogEntry();
            //'browser_id', 'ip_id', 'user_id', 'operation_id'
            $entry->browser_id = $browser->id;
            $entry->ip_id = $ip->id;
            $entry->operation_id = $operation->id;
            $entry->save();
        }
        return $entry->toArray();
    }

    public function setUser($user)
    {
        $ip = LogIp::firstOrCreate(['ip' => request()->ip()]);
        $browser = LogBrowser::firstOrCreate(['browser_info' => request()->server('HTTP_USER_AGENT')]);
        $operation = LogOperation::firstOrCreate(['name' => 'register']);
        $entry = $this->repository->getRecentWithoutUser($ip, $browser, $operation);
        if (null != $entry && null != $user) {
            $entry->user_id = $user->id;
            $entry->save();
        }
        return [
            'ip_id' => $ip->id,
            'browser_id' => $browser->id,
            'user_id' => $user->id
        ];
    }

    public function logUpdate($class)
    {
        $changes = $this->arrayChanges($class);
        if (null != $changes) {
            $this->saveEntry('updated', $class, $changes);
            //$this->writeLogToFile($class, $entry, $changes, 'CHANGES');
            
        }
    }

    public function logCreated($class)
    {
        $this->saveEntry('created', $class);
        //$this->writeLogToFile($class, $entry, $this->arrayAttributes($class), 'CREATION');
    }

    public function logDeleted($class)
    {

        $data = $this->arrayAttributes($class);
        $this->saveEntry('deleted', $class, $data);
        //$this->writeLogToFile($class, $entry, $data, 'REMOVED');
    }

    /**
     * 'id', 'browser_id', 'ip_id', 'user_id', 'operation_id', 'table', 'table_id'
     * @param type $operation
     * @param type $class
     */
    public function saveEntry($operation, $class, $notes = null)
    {
        $operation_id = LogOperation::firstOrCreate(['name' => $operation])->id;
        if (null == user()) {
            log_info('no-user-log', $notes);
            return;
        }
        $info = user()->useragent();
        $entry = new LogEntry();
        $entry->browser_id = $info['browser_id'];
        $entry->ip_id = $info['ip_id'];
        $entry->operation_id = $operation_id;
        $entry->user_id = user()->id;
        $entry->table = $class::TABLE_NAME;
        $entry->table_id = $class->getKey();
        $entry->notes = str_replace("|", "\n", $notes);

        $entry->save();

        return $entry;
    }
    
    private function writeLogToFile($class, $entry, $data, $action)
    {
        if (null == $entry) {
            return;
        }
        $file = storage_path('logs/entries/') . date('Ymd') . '_' . $class::TABLE_NAME . '.log';
        file_put_contents($file, 'ENTRY: ' . $entry->id . ' [' . $entry->created_at . "]\n", FILE_APPEND);
        file_put_contents($file, $action . ': ' . $data . "\n", FILE_APPEND);
    }
    
    
    public function getOrCreateEntry(Visit $visit, $operation)
    {
        $entry = LogEntry::firstOrCreate([
            'sessionid'=>$visit::$data[Visit::DATA_SESSION_ID]
        ], [
            'ip'=>LogIp::firstOrCreate(['ip' => request()->ip()]),
            'browser'=>LogBrowser::firstOrCreate(['browser_info' => request()->server('HTTP_USER_AGENT')]),
            'operation'=>LogOperation::firstOrCreate(['name' => $operation])
        ]);

        return $entry->toArray();
    }

}
