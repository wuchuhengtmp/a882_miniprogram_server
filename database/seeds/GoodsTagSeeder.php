<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('
        INSERT INTO `goods_tags` (`id`, `name`) VALUES
            (\'3\', \'19款 / 自动挡\'),
             (\'4\', \'18款 / 自动挡\'),
             (\'5\', \'17款 / 自动挡\'),
             (\'6\', \'16款 / 自动挡\'),
             (\'7\', \'14款 / 自动挡\'),
             (\'8\', \'纯电动\'),
             (\'9\', \'20款 / 自动挡\'),
             (\'10\', \'15款/自动挡\'),
             (\'11\', \'13款/自动挡\'),
             (\'12\', \'12款/自动挡\'),
             (\'13\', \'11款/自动挡\'),
             (\'14\', \'10款/自动挡\'),
             (\'15\', \'油电混合\')
        ');
    }
}
