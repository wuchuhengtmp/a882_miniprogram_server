<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `roles` VALUES (\'1\', \'admin\', null, null, null);');
        DB::insert('INSERT INTO `roles` VALUES (\'2\', \'shop\', null, null, null);');
    }
}
