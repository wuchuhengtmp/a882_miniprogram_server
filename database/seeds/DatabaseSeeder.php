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

         // users
        DB::insert(' INSERT INTO `users` (`id`, `username`, `email`, `email_verified_code`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (\'1\', \'admin\', NULL, NULL, NULL, \'$2y$10$DMiV2xdfz755wLr5RG9.wOU7o4ygqOKq9vM7xxoxXFrAHKL4hOTkC\', NULL, NULL, NULL)');

    }
}
