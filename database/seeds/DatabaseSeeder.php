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

        DB::insert("INSERT INTO `permissions` (`id`, `controller`, `method`, `note`, `created_at`, `updated_at`) VALUES
        ('1', 'App_Http_Controllers_AdminApi_UsersController', 'create', '创建门店', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('2', 'App_Http_Controllers_AdminApi_UsersController', 'index', '门店列表', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('3', 'App_Http_Controllers_AdminApi_UsersController', 'updateIsDisable', '修改门店状态', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('4', 'App_Http_Controllers_AdminApi_UsersController', 'update', '修改门店', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('5', 'App_Http_Controllers_AdminApi_UsersController', 'showShopName', '获取门店名列表', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('6', 'App_Http_Controllers_AdminApi_UsersController', 'show', '获取当前登录信息', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('7', 'App_Http_Controllers_AdminApi_CategoresController', 'index', '获取车型列表', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('8', 'App_Http_Controllers_AdminApi_CategoresController', 'create', '添加车型', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('9', 'App_Http_Controllers_AdminApi_CategoresController', 'update', '更新车型', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('10', 'App_Http_Controllers_AdminApi_BrandsController', 'create', '添加品牌', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('11', 'App_Http_Controllers_AdminApi_BrandsController', 'edit', '修改品牌', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('12', 'App_Http_Controllers_AdminApi_BrandsController', 'index', '获取品牌列表', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('13', 'App_Http_Controllers_AdminApi_GoodstagsController', 'index', '获取商品标签列表', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('14', 'App_Http_Controllers_AdminApi_GoodstagsController', 'create', '添加商品标签', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('15', 'App_Http_Controllers_AdminApi_GoodstagsController', 'edit', '修改商品标签', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('16', 'App_Http_Controllers_AdminApi_AlbumsController', 'create', '上传图片', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('17', 'App_Http_Controllers_AdminApi_ConfigController', 'index', '获取配置', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('18', 'App_Http_Controllers_AdminApi_IPController', 'show', '获取公网ip', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('19', 'App_Http_Controllers_AdminApi_UserBannersController', 'destroy', '删除门店的图片', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('20', 'App_Http_Controllers_AdminApi_GoodsController', 'created', '添加车子', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('21', 'App_Http_Controllers_AdminApi_GoodsController', 'updateStatus', '更新车子上下架状态', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('22', 'App_Http_Controllers_AdminApi_GoodsController', 'update', '编辑车子', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('23', 'App_Http_Controllers_AdminApi_GoodsController', 'index', '获取车子列表', '2020-11-01 16:02:18', '2020-11-01 16:02:18'),
            ('24', 'App_Http_Controllers_AdminApi_GoodsController', 'showStatus', '修改车子上下架状态', '2020-11-01 16:02:18', '2020-11-01 16:02:18');
");
        DB::insert('INSERT INTO `permissions` (`id`, `controller`, `method`, `note`, `created_at`, `updated_at`) VALUES (\'25\', \'App_Http_Controllers_AdminApi_SlidesController\', \'create\', \'添加幻灯片\', NULL, NULL);');
        DB::insert('INSERT INTO `permissions` (`id`, `controller`, `method`, `note`, `created_at`, `updated_at`) VALUES (\'26\', \'App_Http_Controllers_AdminApi_SlidesController\', \'index\', \'获取幻灯片\', NULL, NULL);');

        // 角色权限
        DB::insert('INSERT INTO `role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
            (\'2\', \'3\', NULL, NULL),
            (\'2\', \'4\', NULL, NULL),
            (\'2\', \'5\', NULL, NULL),
            (\'2\', \'6\', NULL, NULL),
            (\'2\', \'7\', NULL, NULL),
            (\'2\', \'12\', NULL, NULL),
            (\'2\', \'13\', NULL, NULL),
            (\'2\', \'16\', NULL, NULL),
            (\'2\', \'17\', NULL, NULL),
            (\'2\', \'18\', NULL, NULL),
            (\'2\', \'19\', NULL, NULL),
            (\'2\', \'20\', NULL, NULL),
            (\'2\', \'21\', NULL, NULL),
            (\'2\', \'22\', NULL, NULL),
            (\'2\', \'23\', NULL, NULL),
            (\'2\', \'24\', NULL, NULL)'
        );


    }
}
