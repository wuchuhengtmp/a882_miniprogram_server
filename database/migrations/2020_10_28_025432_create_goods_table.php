<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGoodsTable extends Migration
{
    public $tableName = 'goods';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('商品名');
            $table->integer('category_id')->comment('车型id');
            $table->integer('brand_id')->comment('品牌id');
            $table->integer('user_id')->comment('用户id');
            $table->float('cost')->comment('租金(按天)');
            $table->string('tag_ids')->comment('标签id json组');
            $table->integer('total')->comment('库存');
            $table->integer('status')->comment('0下架1上架');
            $table->integer('banner_id')->comment('图片');
            $table->float('insurance_cost')->comment('驾无忧保险费（按天）');
            $table->float('base_cost')->comment('基本服务保障（按天）');
            $table->float('service_cost')->comment('手续费');
            $table->float('pledge_cost')->comment('押金');
            $table->softDeletes();
            $table->timestamps();
        });
        DB::select("ALTER TABLE {$this->tableName} COMMENT = '商品表'");
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
