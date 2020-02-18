<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogEntry extends Migration
{
    /**
    /**
     * Schema table name to migrate
     * @var string
     */
    public $schema_table = 'log_entry';

    /**
     * Run the migrations.
     * @table log_entry
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
            $table->bigIncrements('id');
            $table->unsignedInteger('browser_id');
            $table->unsignedInteger('ip_id');
            $table->unsignedInteger('operation_id');
            $table->unsignedInteger('user_id')->nullable();
            
            $table->string('table', 90)->nullable();
            $table->unsignedBigInteger('table_id')->nullable();
            $table->text('notes')->nullable();

           
            $table->timestamps();

            $table->index(["browser_id"]);
            $table->foreign(['browser_id'])
                ->references('id')->on('log_browser')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->index(["ip_id"]);
            $table->foreign(['ip_id'])
                ->references('id')->on('log_ip')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            
            $table->index(["operation_id"]);
            $table->foreign(['operation_id'])
                ->references('id')->on('log_operation')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            
            $table->index(["user_id"]);
            $table->foreign(["user_id"])
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
