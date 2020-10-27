<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateConfigsTabls extends Migration
{
    public $tableName = 'configs';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('配置名');
            $table->string('value')->comment('配置值');
            $table->string('note')->nullable()->comment('备注');
            $table->timestamps();
        });
        DB::select("ALTER TABLE {$this->tableName} COMMENT = '配置表'");
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
