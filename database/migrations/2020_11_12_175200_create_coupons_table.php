<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCouponsTable extends Migration
{
    public $tableName = 'coupons';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->float('cost')->comment('费用');
            $table->string('name')->comment('名称');
            $table->string('des')->comment('说明');
            $table->integer('expired_day')->comment('期限时长');
            $table->integer('is_use')->comment('1使用0禁用');
            $table->integer('give_type')->comment('发放方式: 1新手发放2手动发放');
            $table->integer('album_id')->comment('封面的相册id');
            $table->integer('is_alert')->comment('是否主动提醒');
            $table->timestamps();
        });
        DB::select("ALTER TABLE {$this->tableName} COMMENT = '优惠券表'");
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
