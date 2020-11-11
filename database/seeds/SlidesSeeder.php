<?php

use Illuminate\Database\Seeder;

class SlidesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `slides` VALUES (\'1\', \'4\', \'3\', \'2020-11-03 15:51:52\', \'2020-11-03 15:51:52\');');
        DB::insert('INSERT INTO `slides` VALUES (\'2\', \'6\', \'5\', \'2020-11-03 15:52:01\', \'2020-11-03 15:52:01\');');
        DB::insert('INSERT INTO `slides` VALUES (\'3\', \'8\', \'7\', \'2020-11-03 15:52:13\', \'2020-11-03 15:52:13\');');
    }
}
