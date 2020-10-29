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


        // 配置表
        DB::insert('INSERT INTO `configs` (`id`, `name`, `value`, `note`, `created_at`, `updated_at`) VALUES (\'1\', \'AMAP_KEY\', \'b9ec8422cefaed1483796733ed761921\', NULL, NULL, NULL)');

        // 店铺测试数据
        DB::insert(' INSERT INTO `albums` (`id`, `path`, `disk`, `deleted_at`, `created_at`, `updated_at`) VALUES (\'1\', \'1zojKxmGZL2kkSBL1t6C0rEFC8stD9s6yLNtsg4W.jpeg\', \'public\', NULL, \'2020-10-28 07:41:53\', \'2020-10-28 07:42:02\') ');
        DB::insert(' INSERT INTO `albums` (`id`, `path`, `disk`, `deleted_at`, `created_at`, `updated_at`) VALUES (\'2\', \'JrPJpNpuFF8vo8kAfPiHM3xZBCuFKHdK7vTWuSIV.jpeg\', \'public\', NULL, \'2020-10-28 07:41:58\', \'2020-10-28 07:42:02\') ');
        DB::insert(' INSERT INTO `user_banners` (`id`, `user_id`, `album_id`, `created_at`, `updated_at`) VALUES (\'1\', \'2\', \'1\', \'2020-10-28 08:26:05\', \'2020-10-28 08:26:05\') ');
        DB::insert(' INSERT INTO `user_banners` (`id`, `user_id`, `album_id`, `created_at`, `updated_at`) VALUES (\'2\', \'2\', \'2\', \'2020-10-28 08:26:05\', \'2020-10-28 08:26:05\') ');

        DB::insert('INSERT INTO `user_roles` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES (\'2\', \'2\', \'2\', NULL, NULL)');
        DB::insert('INSERT INTO `users` (`id`, `username`, `email`, `email_verified_code`, `email_verified_at`, `password`, `nickname`, `phone`, `address`, `tags`, `rate`, `start_time`, `end_time`, `latitude`, `longitude`, `region_id`, `is_disable`, `remember_token`, `created_at`, `updated_at`) VALUES (\'2\', \'test1\', NULL, NULL, NULL, \'test1\', \'测试门店1\', \'13427969604\', \'广东省惠州市惠阳区淡水街道政通达沥青拌和厂\', \'[\"%E6%9C%BA%E5%9C%BA\",\"%E7%81%AB%E8%BD%A6%E7%AB%99\"]\', \'5\', \'12:07:00\', \'12:14:00\', \'22.862637\', \'114.497267\', \'441303\', \'1\', NULL, \'2020-10-28 07:42:02\', \'2020-10-28 07:42:02\')');


    }
}
