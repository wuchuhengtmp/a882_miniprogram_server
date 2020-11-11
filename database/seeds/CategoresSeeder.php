<?php

use Illuminate\Database\Seeder;

class CategoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `categores` VALUES (\'1\', \'新能源\', \'0\', null, null);');
        DB::insert('INSERT INTO `categores` VALUES (\'2\', \'小型轿车\', \'0\', null, null);');
        DB::insert('INSERT INTO `categores` VALUES (\'3\', \'中型轿车\', \'0\', null, null);');
        DB::insert('INSERT INTO `categores` VALUES (\'4\', \'大型轿车\', \'0\', null, null);');
        DB::insert('INSERT INTO `categores` VALUES (\'5\', \'SUV\', \'0\', null, null);');
        DB::insert('INSERT INTO `categores` VALUES (\'6\', \'商务型\', \'0\', null, null);');
        DB::insert('INSERT INTO `categores` VALUES (\'7\', \'敞篷 四座\', \'0\', null, null);');
        DB::insert('INSERT INTO `categores` VALUES (\'8\', \'敞篷  两座\', \'0\', null, null);');
    }
}
