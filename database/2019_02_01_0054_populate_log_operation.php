<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class PopulateLogOperation extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $schema_table = 'log_operation';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ([
            'register', 'created', 'updated', 'deleted', 'cart'
        ] as $name) {
            DB::table($this->schema_table)->updateOrInsert([
            'name' => $name
            ]);
        }
    }
    
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
