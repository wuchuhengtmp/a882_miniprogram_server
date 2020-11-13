<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        db::insert('insert into `users` (`id`, `username`, `email`, `email_verified_code`, `email_verified_at`, `password`, `nickname`, `phone`, `address`, `tags`, `rate`, `start_time`, `end_time`, `latitude`, `longitude`, `region_id`, `is_disable`, `remember_token`, `created_at`, `updated_at`) values (\'1\', \'admin\', null, null, null, \'$2y$10$5dDfvk9IWAK1sCBdL8yQO.0T6THFfY9ArdfeBwMoGLDEDbbCSOYJa\', \'系统管理员\', null, null, null, \'0\', null, null, null, null, null, \'1\', null, null, null);');
        db::insert('insert into `users` (`id`, `username`, `email`, `email_verified_code`, `email_verified_at`, `password`, `nickname`, `phone`, `address`, `tags`, `rate`, `start_time`, `end_time`, `latitude`, `longitude`, `region_id`, `is_disable`, `remember_token`, `created_at`, `updated_at`) values (\'2\', \'test1\', null, null, null, \'test1\', \'测试门店1\', \'13427969604\', \'广东省惠州市惠阳区淡水街道政通达沥青拌和厂\', \'[\"%e6%9c%ba%e5%9c%ba\",\"%e7%81%ab%e8%bd%a6%e7%ab%99\"]\', \'1\', \'12:07:00\', \'12:14:00\', \'22.862637\', \'114.497267\', \'441303\', \'1\', null, \'2020-10-28 07:42:02\', \'2020-10-28 07:42:02\');');
        db::insert('insert into `users` (`id`, `username`, `email`, `email_verified_code`, `email_verified_at`, `password`, `nickname`, `phone`, `address`, `tags`, `rate`, `start_time`, `end_time`, `latitude`, `longitude`, `region_id`, `is_disable`, `remember_token`, `created_at`, `updated_at`) values (\'3\', \'test2\', null, null, null, \'$2y$10$i0b/trfy/kmqrrs0rgx3funv5y5j9jknomwvnvdhcejqxclijsqiy\', \'惠东测试店\', \'13427969604\', \'广东省惠州市惠东县平山街道文体街31号清晖花园\', \'[\"%e7%81%ab%e8%bd%a6%e7%ab%99\"]\', \'2\', \'12:09:00\', \'02:05:00\', \'22.972283\', \'114.724041\', \'441323\', \'1\', null, \'2020-11-05 21:59:42\', \'2020-11-05 21:59:42\');');
        db::insert('insert into `users` (`id`, `username`, `email`, `email_verified_code`, `email_verified_at`, `password`, `nickname`, `phone`, `address`, `tags`, `rate`, `start_time`, `end_time`, `latitude`, `longitude`, `region_id`, `is_disable`, `remember_token`, `created_at`, `updated_at`) values (\'4\', \'test3\', null, null, null, \'$2y$10$9glcdaqfssi/xe9jc/qsjoslst16xwxpzoqnyju57rp8y4lhcjnf6\', \'惠阳测试店\', \'13427969604\', \'广东省惠州市惠阳区秋长街道鸡婆岭\', \'[\"%e7%81%ab%e8%bd%a6%e7%ab%99\"]\', \'3\', \'12:07:00\', \'12:10:00\', \'22.889709\', \'114.440267\', \'441303\', \'1\', null, \'2020-11-05 22:02:15\', \'2020-11-05 22:02:15\');');
    }
}
