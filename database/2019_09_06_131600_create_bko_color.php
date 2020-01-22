<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBkoColor extends Migration
{

    /**
     * Schema table name to migrate
     * @var string
     */
    public $schema_table = 'bko_color';

    /**
     * Run the migrations.
     * @table bko_color
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
            
            $table->string('code', 20)->unique();
            $table->string('name', 100)->nullable();
            $table->string('hexa', 7)->nullable();

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
