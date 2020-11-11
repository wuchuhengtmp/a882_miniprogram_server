<?php

use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `brands` VALUES (\'1\', \'野马 敞篷\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'2\', \'丰田 威驰\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'3\', \'特斯拉\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'4\', \'吉利汽车\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'5\', \'丰田 凯美瑞\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'6\', \'众泰\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'7\', \' 保时捷\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'8\', \'奥迪 A6L\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'9\', \'欧陆\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'10\', \'法拉利 458\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'11\', \'大众 迈腾\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'12\', \'艾力绅\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'13\', \'本田CRV\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'14\', \'宝马五系\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'15\', \'奔驰  E级\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'16\', \'别克 GL8 首席\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'17\', \'别克 GL8 陆尊\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'18\', \'奔驰S级\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'19\', \'现代悦动\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'20\', \'东风 SX6\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'21\', \'起亚 K2\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'22\', \'起亚 焕驰\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'23\', \'租车押金\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'24\', \'宝马二系\', null, null);');
        DB::insert('INSERT INTO `brands` VALUES (\'25\', \'奔驰 威霆 九座\', null, null);');
    }
}
