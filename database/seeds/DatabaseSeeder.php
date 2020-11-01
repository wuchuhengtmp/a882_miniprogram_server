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

        // 权限表

        DB::insert('INSERT INTO `permissions` (`id`, `controller`, `method`, `note`, `created_at`, `updated_at`) VALUES
            (\'1\', \'App\\Http\\Controllers\\AdminApi\\UsersController\', \'create\', \'创建门店\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'2\', \'App\\Http\\Controllers\\AdminApi\\UsersController\', \'index\', \'门店列表\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'3\', \'App\\Http\\Controllers\\AdminApi\\UsersController\', \'updateIsDisable\', \'修改门店状态\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'4\', \'App\\Http\\Controllers\\AdminApi\\UsersController\', \'update\', \'修改门店\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'5\', \'App\\Http\\Controllers\\AdminApi\\UsersController\', \'showShopName\', \'获取门店名列表\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'6\', \'App\\Http\\Controllers\\AdminApi\\UsersController\', \'show\', \'获取当前登录信息\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'7\', \'App\\Http\\Controllers\\AdminApi\\CategoresController\', \'index\', \'获取车型列表\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'8\', \'App\\Http\\Controllers\\AdminApi\\CategoresController\', \'create\', \'添加车型\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'9\', \'App\\Http\\Controllers\\AdminApi\\CategoresController\', \'update\', \'更新车型\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'10\', \'App\\Http\\Controllers\\AdminApi\\BrandsController\', \'create\', \'添加品牌\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'11\', \'App\\Http\\Controllers\\AdminApi\\BrandsController\', \'edit\', \'修改品牌\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'12\', \'App\\Http\\Controllers\\AdminApi\\BrandsController\', \'index\', \'获取品牌列表\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'13\', \'App\\Http\\Controllers\\AdminApi\\GoodstagsController\', \'index\', \'获取商品标签列表\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'14\', \'App\\Http\\Controllers\\AdminApi\\GoodstagsController\', \'create\', \'添加商品标签\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'15\', \'App\\Http\\Controllers\\AdminApi\\GoodstagsController\', \'edit\', \'修改商品标签\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'16\', \'App\\Http\\Controllers\\AdminApi\\AlbumsController\', \'create\', \'上传图片\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'17\', \'App\\Http\\Controllers\\AdminApi\\ConfigController\', \'index\', \'获取配置\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'18\', \'App\\Http\\Controllers\\AdminApi\\IPController\', \'show\', \'获取公网ip\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'19\', \'App\\Http\\Controllers\\AdminApi\\UserBannersController\', \'destroy\', \'删除门店的图片\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'20\', \'App\\Http\\Controllers\\AdminApi\\GoodsController\', \'created\', \'添加车子\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'21\', \'App\\Http\\Controllers\\AdminApi\\GoodsController\', \'updateStatus\', \'更新车子上下架状态\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'22\', \'App\\Http\\Controllers\\AdminApi\\GoodsController\', \'update\', \'编辑车子\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'23\', \'App\\Http\\Controllers\\AdminApi\\GoodsController\', \'index\', \'获取车子列表\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\'),
            (\'24\', \'App\\Http\\Controllers\\AdminApi\\GoodsController\', \'showStatus\', \'修改车子上下架状态\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');
');





    }
}
