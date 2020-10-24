<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAlbumsTable extends Migration
{
    public $tableName = 'albums';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('path')->comment('图片保存路径');
            $table->string('disk')->comment('保存硬盘');
            $table->softDeletes();
            $table->timestamps();
        });
        DB::select("ALTER TABLE {$this->tableName} COMMENT = '相册表'");
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
