<?php

namespace Logs\Model\Entities;

use Illuminate\Database\Eloquent\Model;

class LogOperation extends Model
{
    
    /**
     * table name
     */
    const TABLE_NAME = 'log_operation';
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
    public $visible = ['id', 'name'];
    
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
    public static function getLogOperation() {
        return LogOperation::firstOrNew([
        'id'=>null,
        'name'=>null,
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
    const FIELD_NAME = 'name';
    
    
    
    /**
     * Foreign key constraint
     * @return \Logs\Model\Entities\LogEntry
     */
    public function log_entry() {
        return $this->hasMany(\Logs\Model\Entities\LogEntry::class, 'operation_id');
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
    public function getName() {
        return $this->name;
    }
    
    
    
    /**
     * 
     * @param {$item.type} $value
     * @return \LogOperation
     */
    public function setId($value) {
        $this->id = $value;
        return $this;
    }
    
    /**
     * 
     * @param {$item.type} $value
     * @return \LogOperation
     */
    public function setName($value) {
        $this->name = $value;
        return $this;
    }
    
    
    
    /**
     * Save the model object
     * @return \LogOperation
     */
    public function store() {
        $this->save();
        return $this;
    }
}
