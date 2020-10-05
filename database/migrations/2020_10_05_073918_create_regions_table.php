<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    public $tableName = 'regions';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {



        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('parent_id');
            $table->string('short_name');
            $table->smallInteger('level_type');
            $table->string('city_code');
            $table->string('zip_code');
            $table->string('merger_name');
            $table->float('longitude');
            $table->float('latitude');
            $table->string('pinyin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
