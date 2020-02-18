<?php

namespace Logs\Model\Entities;

use Illuminate\Database\Eloquent\Model;

class LogIp extends Model
{
    
    /**
     * table name
     */
    const TABLE_NAME = 'log_ip';
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
    public $visible = ['id', 'ip'];
    
     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * 
     * @return \StdClass
     */
    public static function getLogIp() {
        return LogIp::firstOrNew([
        'id'=>null,
        'ip'=>null,
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
    const FIELD_IP = 'ip';
    
    
    
    /**
     * Foreign key constraint
     * @return \Logs\Model\Entities\LogEntry
     */
    public function log_entry() {
        return $this->hasMany(\Logs\Model\Entities\LogEntry::class, 'ip_id');
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
    public function getIp() {
        return $this->ip;
    }
    
    
    
    /**
     * 
     * @param {$item.type} $value
     * @return \LogIp
     */
    public function setId($value) {
        $this->id = $value;
        return $this;
    }
    
    /**
     * 
     * @param {$item.type} $value
     * @return \LogIp
     */
    public function setIp($value) {
        $this->ip = $value;
        return $this;
    }
    
    
    
    /**
     * Save the model object
     * @return \LogIp
     */
    public function store() {
        $this->save();
        return $this;
    }
}
