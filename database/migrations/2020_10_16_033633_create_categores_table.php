<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCategoresTable extends Migration
{
    public $tableName = 'categores';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('分类名');
            $table->integer('order_no')
                ->default(0)
                ->comment('排序号');
            $table->timestamps();
        });
        DB::select("ALTER TABLE {$this->tableName} COMMENT = '车辆分类表'");
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
