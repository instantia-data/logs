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
    public $visible = ['id', 'browser_id', 'ip_id', 'operation_id', 'user_id', 'sessionid', 'table', 'table_id', 'notes', 'created_at'];
    
     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    
    
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
     * text
     */
    const FIELD_SESSIONID = 'sessionid';
    
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
     * text
     */
    const FIELD_NOTES = 'notes';
    
    /**
     * 
     * timestamp
     */
    const FIELD_CREATED_AT = 'created_at';
    
    
    /**
     * Foreign key constraint
     * @return \Logs\Model\Entities\LogBrowser
     */
    public function browser() 
    {
        return $this->belongsTo(\Logs\Model\Entities\LogBrowser::class, 'browser_id');
    }
    
    /**
     * Foreign key constraint
     * @return \Logs\Model\Entities\LogIp
     */
    public function ip() 
    {
        return $this->belongsTo(\Logs\Model\Entities\LogIp::class, 'ip_id');
    }
    
    /**
     * Foreign key constraint
     * @return \Logs\Model\Entities\LogOperation
     */
    public function operation() 
    {
        return $this->belongsTo(\Logs\Model\Entities\LogOperation::class, 'operation_id');
    }
    
    /**
     * Foreign key constraint
     * @return \Authpack\Model\Entities\User
     */
    public function user() 
    {
        return $this->belongsTo(\Authpack\Model\Entities\User::class, 'user_id');
    }
    
    /**
     * 
     * @return integer
     */
    public function getId() 
    {
        return $this->id;
    }
    
    /**
     * 
     * @return int
     */
    public function getBrowserId() 
    {
        return $this->browser_id;
    }
    
    /**
     * 
     * @return int
     */
    public function getIpId() 
    {
        return $this->ip_id;
    }
    
    /**
     * 
     * @return int
     */
    public function getOperationId() 
    {
        return $this->operation_id;
    }
    
    /**
     * 
     * @return int
     */
    public function getUserId() 
    {
        return $this->user_id;
    }
    
    /**
     * 
     * @return text
     */
    public function getSessionid() 
    {
        return $this->sessionid;
    }
    
    /**
     * 
     * @return string
     */
    public function getTable() 
    {
        return $this->table;
    }
    
    /**
     * 
     * @return integer
     */
    public function getTableId() 
    {
        return $this->table_id;
    }
    
    /**
     * 
     * @return text
     */
    public function getNotes() 
    {
        return $this->notes;
    }
    
    /**
     * 
     * @return timestamp
     */
    public function getCreatedAt() 
    {
        return $this->created_at;
    }
    
}
