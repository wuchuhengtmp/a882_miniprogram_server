<?php

use Illuminate\Database\Seeder;

class UserBannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `user_banners` VALUES (\'1\', \'2\', \'1\', \'2020-10-28 08:26:05\', \'2020-10-28 08:26:05\');');
        DB::insert('INSERT INTO `user_banners` VALUES (\'2\', \'2\', \'2\', \'2020-10-28 08:26:05\', \'2020-10-28 08:26:05\');');
        DB::insert('INSERT INTO `user_banners` VALUES (\'3\', \'3\', \'19\', \'2020-11-05 21:59:42\', \'2020-11-05 21:59:42\');');
        DB::insert('INSERT INTO `user_banners` VALUES (\'4\', \'3\', \'20\', \'2020-11-05 21:59:42\', \'2020-11-05 21:59:42\');');
        DB::insert('INSERT INTO `user_banners` VALUES (\'5\', \'4\', \'21\', \'2020-11-05 22:02:15\', \'2020-11-05 22:02:15\');');
        DB::insert('INSERT INTO `user_banners` VALUES (\'6\', \'4\', \'22\', \'2020-11-05 22:02:15\', \'2020-11-05 22:02:15\');');
        DB::insert('INSERT INTO `user_banners` VALUES (\'7\', \'4\', \'23\', \'2020-11-05 22:02:15\', \'2020-11-05 22:02:15\');');
        DB::insert('INSERT INTO `user_banners` VALUES (\'8\', \'4\', \'24\', \'2020-11-05 22:02:15\', \'2020-11-05 22:02:15\');');
    }
}
