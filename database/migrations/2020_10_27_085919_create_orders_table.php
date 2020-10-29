<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateOrdersTable extends Migration
{
    public $tableName = 'orders';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('out_trade_no')->comment('订单号');
            $table->string('tade_from')->comment('订单来源:alipay(支付宝)wechat(微信)');
            $table->string('pledge_type')->comment('押金方式:cash(现金),credit（信用）');
            $table->string('alipay_trade_no')->nullable()->comment('支付宝订单号');
            $table->string('wechat_trade_no')->nullable()->comment('微信订单号');
            $table->string('name')->comment('商品名称');
            $table->float('price')->comment('价格');
            $table->float('base_cost')->comment('基本保障费（按天）');
            $table->float('service_cost')->comment('手续费');
            $table->float('insurance_cost')->comment('驾无忧保险(按天)');
            $table->float('user_id')->comment('用户');
            $table->string('expend_list')->comment('租金按天费用列表json');
            $table->timestamp('start_at')->comment('取车时间');
            $table->timestamp('end_at')->nullable()->comment('还车时间');
            $table->string('category')->comment('类型');
            $table->string('brand')->comment('品牌');
            $table->string('tags')->comment('标签json组');
            $table->integer('status')->comment(
                '-2未授权资金-1已取消0未付款1预定中2进行中3逾期4还车中5完成6已评价7订单完结，有信用的则解冻余下冻结'
            );
            $table->integer('from_user_id')->comment('取车店id');
            $table->integer('to_user_id')->comment('还车子店id');
            $table->string('credit_out_trade_no')->nullable()->comment('授信订单号');
            $table->string('credit_trade_no')->nullable()->comment('商家授信订单号');
            $table->string('total_freeze_amount')->nullable()->comment('冻结金额');
            $table->string('banners')->comment('商品图片json组');
            $table->string('credit_pay_sign')->nullable()->comment('信用支付签名');
            $table->string('cancel_remark')->nullable()->comment('取消订单理由');
            $table->integer('deduction')->nullable()->comment('声音扣款');

            $table->timestamps();
        });

        DB::select("ALTER TABLE {$this->tableName} COMMENT = '订单表'");
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
