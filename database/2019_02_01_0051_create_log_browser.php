<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogBrowser extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $schema_table = 'log_browser';

    /**
     * Run the migrations.
     * @table log_browser
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->schema_table)) {
            return;
        }
        Schema::create($this->schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('browser_info', 200)->nullable();
            $table->string('browser_version', 10)->nullable();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->schema_table);
     }
}
