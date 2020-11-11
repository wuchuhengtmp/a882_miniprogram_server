<?php

use Illuminate\Database\Seeder;

class PayNoticesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `pay_notices` VALUES (\'1\', \'44\', \'取车证件(身份证+驾驶证)\', \'取车证件(身份证+驾驶证) 内容内容内容内容内容内容内容。\', \'2020-11-10 20:09:55\', \'2020-11-11 09:21:24\');');
        DB::insert('INSERT INTO `pay_notices` VALUES (\'2\', \'45\', \'到店支付押金(双免订单除外)\', \'到店支付押金(双免订单除外)说明内容内容内容内容内容内容内容\', \'2020-11-10 20:30:44\', \'2020-11-11 09:22:13\');');
        DB::insert('INSERT INTO `pay_notices` VALUES (\'3\', \'46\', \'取消订单违约金\', \'取消订单违约金内容内容内容内容内容内容内容内容内容内容内容内容\', \'2020-11-10 20:31:19\', \'2020-11-11 09:22:40\');');
        DB::insert('INSERT INTO `pay_notices` VALUES (\'5\', \'47\', \'注意事项\', \'注意事项   金内容内容内容内容内容内容内容内容内容内容内容内容\', \'2020-11-10 20:55:43\', \'2020-11-11 09:23:02\');');
    }
}
