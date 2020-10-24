<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RegionsSeeder::class);
        $this->call(CategoresSeeder::class);
        $this->call(GoodsTagSeeder::class);
        $this->call(BrandSeeder::class);

         // users
        DB::insert(' INSERT INTO `users` (
         `id`,
         `username`,
         `password`,
         `nickname`
       ) VALUES (
           \'1\',
           \'admin\',
           \'$2y$10$DMiV2xdfz755wLr5RG9.wOU7o4ygqOKq9vM7xxoxXFrAHKL4hOTkC\',
           \'系统管理员\'
       )');

        // roles
        DB::insert('INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
            (\'1\', \'admin\', NULL, NULL),
            (\'2\', \'shop\', NULL, NULL)
');

        // user role
        DB::insert('INSERT INTO `user_roles` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES (\'1\', \'1\', \'1\', NULL, NULL)');




    }
}
