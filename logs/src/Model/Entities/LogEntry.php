<?php

namespace Logs\Model\Entities;

use Illuminate\Database\Eloquent\Model;

class LogEntry extends Model
{
    
    /**
     * table name
     */
    const TABLE_NAME = 'log_entry';
    /**
     * table name
     */
    protected $table = self::TABLE_NAME;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = ['id'];
    
    /**
     * Visible columns.
     */
    public $visible = ['id', 'browser_id', 'ip_id', 'operation_id', 'user_id', 'table', 'table_id', 'notes', 'created_at', 'updated_at'];
    
     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    
    /**
     * 
     * @return \StdClass
     */
    public static function getLogEntry() {
        return LogEntry::firstOrNew([
        'id'=>null,
        'browser_id'=>null,
        'ip_id'=>null,
        'operation_id'=>null,
        'user_id'=>null,
        'table'=>null,
        'table_id'=>null,
        'notes'=>null,
                ]);
    }
    
    
    /**
     * 
     * integer
     */
    const FIELD_ID = 'id';
    
    /**
     * 
     * int
     */
    const FIELD_BROWSER_ID = 'browser_id';
    
    /**
     * 
     * int
     */
    const FIELD_IP_ID = 'ip_id';
    
    /**
     * 
     * int
     */
    const FIELD_OPERATION_ID = 'operation_id';
    
    /**
     * 
     * int
     */
    const FIELD_USER_ID = 'user_id';
    
    /**
     * 
     * string
     */
    const FIELD_TABLE = 'table';
    
    /**
     * 
     * integer
     */
    const FIELD_TABLE_ID = 'table_id';
    
    /**
     * 
     * string
     */
    const FIELD_NOTES = 'notes';
    
    /**
     * 
     * timestamp
     */
    const FIELD_CREATED_AT = 'created_at';
    
    /**
     * 
     * timestamp
     */
    const FIELD_UPDATED_AT = 'updated_at';
    
    
    
    /**
     * Foreign key constraint
     * @return \Logs\Model\Entities\LogBrowser
     */
    public function log_browser() {
        return $this->belongsTo(\Logs\Model\Entities\LogBrowser::class, 'browser_id');
    }
    
    /**
     * Foreign key constraint
     * @return \Logs\Model\Entities\LogIp
     */
    public function log_ip() {
        return $this->belongsTo(\Logs\Model\Entities\LogIp::class, 'ip_id');
    }
    
    /**
     * Foreign key constraint
     * @return \Logs\Model\Entities\LogOperation
     */
    public function log_operation() {
        return $this->belongsTo(\Logs\Model\Entities\LogOperation::class, 'operation_id');
    }
    
    /**
     * Foreign key constraint
     * @return \Logs\Model\Entities\User
     */
    public function user() {
        return $this->belongsTo(\Logs\Model\Entities\User::class, 'user_id');
    }
    
    
    
    /**
     * 
     * @return integer
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * 
     * @return int
     */
    public function getBrowserId() {
        return $this->browser_id;
    }
    
    /**
     * 
     * @return int
     */
    public function getIpId() {
        return $this->ip_id;
    }
    
    /**
     * 
     * @return int
     */
    public function getOperationId() {
        return $this->operation_id;
    }
    
    /**
     * 
     * @return int
     */
    public function getUserId() {
        return $this->user_id;
    }
    
    /**
     * 
     * @return string
     */
    public function getTable() {
        return $this->table;
    }
    
    /**
     * 
     * @return integer
     */
    public function getTableId() {
        return $this->table_id;
    }
    
    /**
     * 
     * @return string
     */
    public function getNotes() {
        return $this->notes;
    }
    
    /**
     * 
     * @return timestamp
     */
    public function getCreatedAt() {
        return $this->created_at;
    }
    
    /**
     * 
     * @return timestamp
     */
    public function getUpdatedAt() {
        return $this->updated_at;
    }
    
    
    
    /**
     * 
     * @param {$item.type} $value
     * @return \LogEntry
     */
    public function setId($value) {
        $this->id = $value;
        return $this;
    }
    
    /**
     * 
     * @param {$item.type} $value
     * @return \LogEntry
     */
    public function setBrowserId($value) {
        $this->browser_id = $value;
        return $this;
    }
    
    /**
     * 
     * @param {$item.type} $value
     * @return \LogEntry
     */
    public function setIpId($value) {
        $this->ip_id = $value;
        return $this;
    }
    
    /**
     * 
     * @param {$item.type} $value
     * @return \LogEntry
     */
    public function setOperationId($value) {
        $this->operation_id = $value;
        return $this;
    }
    
    /**
     * 
     * @param {$item.type} $value
     * @return \LogEntry
     */
    public function setUserId($value) {
        $this->user_id = $value;
        return $this;
    }
    
    /**
     * 
     * @param {$item.type} $value
     * @return \LogEntry
     */
    public function setTable($value) {
        $this->table = $value;
        return $this;
    }
    
    /**
     * 
     * @param {$item.type} $value
     * @return \LogEntry
     */
    public function setTableId($value) {
        $this->table_id = $value;
        return $this;
    }
    
    /**
     * 
     * @param {$item.type} $value
     * @return \LogEntry
     */
    public function setNotes($value) {
        $this->notes = $value;
        return $this;
    }
    
    
    
    /**
     * Save the model object
     * @return \LogEntry
     */
    public function store() {
        $this->save();
        return $this;
    }
}
