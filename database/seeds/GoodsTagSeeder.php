<?php

use Illuminate\Database\Seeder;

class GoodsTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `goods_tags` VALUES (\'3\', \'19款 / 自动挡\', null, null);');
        DB::insert('INSERT INTO `goods_tags` VALUES (\'4\', \'18款 / 自动挡\', null, null);');
        DB::insert('INSERT INTO `goods_tags` VALUES (\'5\', \'17款 / 自动挡\', null, null);');
        DB::insert('INSERT INTO `goods_tags` VALUES (\'6\', \'16款 / 自动挡\', null, null);');
        DB::insert('INSERT INTO `goods_tags` VALUES (\'7\', \'14款 / 自动挡\', null, null);');
        DB::insert('INSERT INTO `goods_tags` VALUES (\'8\', \'纯电动\', null, null);');
        DB::insert('INSERT INTO `goods_tags` VALUES (\'9\', \'20款 / 自动挡\', null, null);');
        DB::insert('INSERT INTO `goods_tags` VALUES (\'10\', \'15款/自动挡\', null, null);');
        DB::insert('INSERT INTO `goods_tags` VALUES (\'11\', \'13款/自动挡\', null, null);');
        DB::insert('INSERT INTO `goods_tags` VALUES (\'12\', \'12款/自动挡\', null, null);');
        DB::insert('INSERT INTO `goods_tags` VALUES (\'13\', \'11款/自动挡\', null, null);');
        DB::insert('INSERT INTO `goods_tags` VALUES (\'14\', \'10款/自动挡\', null, null);');
        DB::insert('INSERT INTO `goods_tags` VALUES (\'15\', \'油电混合\', null, null);');
    }
}
