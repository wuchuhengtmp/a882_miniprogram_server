<?php

use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `user_roles` VALUES (\'1\', \'1\', \'1\', null, null);');
        DB::insert('INSERT INTO `user_roles` VALUES (\'2\', \'2\', \'2\', null, null);');
        DB::insert('INSERT INTO `user_roles` VALUES (\'3\', \'2\', \'3\', \'2020-11-05 21:59:42\', \'2020-11-05 21:59:42\');');
        DB::insert('INSERT INTO `user_roles` VALUES (\'4\', \'2\', \'4\', \'2020-11-05 22:02:15\', \'2020-11-05 22:02:15\');');
    }
}
