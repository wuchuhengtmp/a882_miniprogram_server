<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePayNoticesTable extends Migration
{
    public $tableName = 'pay_notices';

    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->integer('icon_id')->comment('图标相册id');
            $table->string('title')->comment('须知标题');
            $table->string('content')->comment('内容');
            $table->timestamps();
        });
        DB::select("ALTER TABLE {$this->tableName} COMMENT = '支付须知'");
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
