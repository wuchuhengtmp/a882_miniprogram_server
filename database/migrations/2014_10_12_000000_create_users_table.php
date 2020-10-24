<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    public $table_name = 'users';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();
            $table->string('username')->comment('用户账号');
            $table->string('email')->nullable()->unique()->comment('邮箱');
            $table->string('email_verified_code')->nullable()->comment('邮箱验证码');
            $table->timestamp('email_verified_at')->nullable()->comment('验证期限');
            $table->string('password');
            $table->string('nickname')->comment('店名');
            $table->string('phone')->nullable()->comment('手机');
            $table->string('address')->nullable()->comment('地址');
            $table->string('tags')->nullable()->comment('标签');
            $table->integer('rate')->default(0)->comment('评分');
            $table->time('start_time')->nullable()->comment('营业时间');
            $table->time('end_time')->nullable()->comment('结束时间');
            $table->string('latitude')->nullable()->comment('纬度');
            $table->string('longitude')->nullable()->comment('经度');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::select("ALTER TABLE {$this->table_name} COMMENT = '用户表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table_name);
    }
}
