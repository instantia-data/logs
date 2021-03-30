<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLogEntryCreatedAt extends Migration
{
    
    /**
     * Schema table name to migrate
     * @var string
     */
    public $schema_table = 'log_entry';
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn($this->schema_table, 'updated_at')) {
            return;
        }
        Schema::table($this->schema_table, function (Blueprint $table) {
            $table->dropColumn('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->schema_table, function (Blueprint $table) {
            //
        });
    }
}
