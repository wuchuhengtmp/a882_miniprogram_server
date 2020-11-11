<?php

use Illuminate\Database\Seeder;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `role_permissions` VALUES (\'2\', \'3\', null, null);');
        DB::insert('INSERT INTO `role_permissions` VALUES (\'2\', \'4\', null, null);');
        DB::insert('INSERT INTO `role_permissions` VALUES (\'2\', \'5\', null, null);');
        DB::insert('INSERT INTO `role_permissions` VALUES (\'2\', \'6\', null, null);');
        DB::insert('INSERT INTO `role_permissions` VALUES (\'2\', \'7\', null, null);');
        DB::insert('INSERT INTO `role_permissions` VALUES (\'2\', \'12\', null, null);');
        DB::insert('INSERT INTO `role_permissions` VALUES (\'2\', \'13\', null, null);');
        DB::insert('INSERT INTO `role_permissions` VALUES (\'2\', \'16\', null, null);');
        DB::insert('INSERT INTO `role_permissions` VALUES (\'2\', \'17\', null, null);');
        DB::insert('INSERT INTO `role_permissions` VALUES (\'2\', \'18\', null, null);');
        DB::insert('INSERT INTO `role_permissions` VALUES (\'2\', \'19\', null, null);');
        DB::insert('INSERT INTO `role_permissions` VALUES (\'2\', \'20\', null, null);');
        DB::insert('INSERT INTO `role_permissions` VALUES (\'2\', \'21\', null, null);');
        DB::insert('INSERT INTO `role_permissions` VALUES (\'2\', \'22\', null, null);');
        DB::insert('INSERT INTO `role_permissions` VALUES (\'2\', \'23\', null, null);');
        DB::insert('INSERT INTO `role_permissions` VALUES (\'2\', \'24\', null, null);');
    }
}
