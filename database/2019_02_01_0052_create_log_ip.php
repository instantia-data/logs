<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogIp extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $schema_table = 'log_ip';

    /**
     * Run the migrations.
     * @table bko_log_ip
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
            $table->string('ip', 20)->nullable();
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
