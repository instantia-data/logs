<?php

namespace Logs\Model\Entities;

use Illuminate\Database\Eloquent\Model;

class LogBrowser extends Model
{
    
    /**
     * table name
     */
    const TABLE_NAME = 'log_browser';
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
    public $visible = ['id', 'browser_info', 'browser_version', 'created_at', 'updated_at'];
    
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
    public static function getLogBrowser() {
        return LogBrowser::firstOrNew([
        'id'=>null,
        'browser_info'=>null,
        'browser_version'=>null,
                ]);
    }
    
    
    /**
     * 
     * int
     */
    const FIELD_ID = 'id';
    
    /**
     * 
     * string
     */
    const FIELD_BROWSER_INFO = 'browser_info';
    
    /**
     * 
     * string
     */
    const FIELD_BROWSER_VERSION = 'browser_version';
    
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
     * @return \Logs\Model\Entities\LogEntry
     */
    public function log_entry() {
        return $this->hasMany(\Logs\Model\Entities\LogEntry::class, 'browser_id');
    }
    
    
    
    /**
     * 
     * @return int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * 
     * @return string
     */
    public function getBrowserInfo() {
        return $this->browser_info;
    }
    
    /**
     * 
     * @return string
     */
    public function getBrowserVersion() {
        return $this->browser_version;
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
     * @return \LogBrowser
     */
    public function setId($value) {
        $this->id = $value;
        return $this;
    }
    
    /**
     * 
     * @param {$item.type} $value
     * @return \LogBrowser
     */
    public function setBrowserInfo($value) {
        $this->browser_info = $value;
        return $this;
    }
    
    /**
     * 
     * @param {$item.type} $value
     * @return \LogBrowser
     */
    public function setBrowserVersion($value) {
        $this->browser_version = $value;
        return $this;
    }
    
    
    
    /**
     * Save the model object
     * @return \LogBrowser
     */
    public function store() {
        $this->save();
        return $this;
    }
}
