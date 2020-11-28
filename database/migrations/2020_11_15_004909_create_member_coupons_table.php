<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMemberCouponsTable extends Migration
{
    public $tablename = 'member_coupons';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tablename, function (Blueprint $table) {
            $table->id();
            $table->float('cost')->comment('费用');
            $table->string('name')->comment('名称');
            $table->string('des')->comment('说明');
            $table->timestamp('expired_at')->comment('期限时长');
            $table->integer('album_id')->comment('封面的相册id');
            $table->integer('is_alert')->comment('1已经提醒0不是');
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
        Schema::dropIfExists($this->tablename);
    }
}
