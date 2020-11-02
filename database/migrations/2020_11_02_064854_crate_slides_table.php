<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CrateSlidesTable extends Migration
{
    public $tableName = 'slides';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('slide_id')->comment('图片');
            $table->string('detail_id')->comment('详情图片');
            $table->timestamps();
        });
        DB::select("ALTER TABLE {$this->tableName} COMMENT = '幻灯表'");
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
