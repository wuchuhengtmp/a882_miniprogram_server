<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `member_roles` (`id`, `name`, `created_at`, `updated_at`) VALUES (\'1\', \'用户\', NULL, NULL);');
        DB::insert('INSERT INTO `member_roles` (`id`, `name`, `created_at`, `updated_at`) VALUES (\'2\', \'推广员\', NULL, NULL);');
        DB::insert('INSERT INTO `member_roles` (`id`, `name`, `created_at`, `updated_at`) VALUES (\'3\', \'业务员\', NULL, NULL);');
    }
}
