<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMembersTable extends Migration
{
    public $tableName = 'members';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('avatar_url')->comment('头像');
            $table->string('city')->comment('城市');
            $table->string('country')->comment('国家');
            $table->string('gender')->comment('0女1男2不知道');
            $table->string('language')->comment('语言');
            $table->string('nickName')->comment('昵称');
            $table->string('province')->comment('省份');
            $table->string('open_id')->comment('识别码');
            $table->string('phone')->nullable()->comment('手机号');
            $table->string('session_key')->comment('用于解密手机号');
            $table->integer('member_role_id')
                ->default(1)
                ->comment('用户角色');
            $table->string('platform')->comment('账号来源平台wechat微信alipay支付宝');
            $table->timestamps();
        });
        DB::select("ALTER TABLE {$this->tableName} COMMENT = '客户表'");
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
