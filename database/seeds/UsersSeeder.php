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
        DB::insert('INSERT INTO `users` VALUES (\'1\', \'admin\', null, null, null, \'$2y$10$DMiV2xdfz755wLr5RG9.wOU7o4ygqOKq9vM7xxoxXFrAHKL4hOTkC\', \'系统管理员\', null, null, null, \'0\', null, null, null, null, null, \'1\', null, null, null);');
        DB::insert('INSERT INTO `users` VALUES (\'2\', \'test1\', null, null, null, \'test1\', \'测试门店1\', \'13427969604\', \'广东省惠州市惠阳区淡水街道政通达沥青拌和厂\', \'[\"%E6%9C%BA%E5%9C%BA\",\"%E7%81%AB%E8%BD%A6%E7%AB%99\"]\', \'1\', \'12:07:00\', \'12:14:00\', \'22.862637\', \'114.497267\', \'441303\', \'1\', null, \'2020-10-28 07:42:02\', \'2020-10-28 07:42:02\');');
        DB::insert('INSERT INTO `users` VALUES (\'3\', \'test2\', null, null, null, \'$2y$10$i0B/Trfy/KMQrrS0RGX3FunV5Y5j9JkNOMwVNvdHcEJqXcLIjSQIy\', \'惠东测试店\', \'13427969604\', \'广东省惠州市惠东县平山街道文体街31号清晖花园\', \'[\"%E7%81%AB%E8%BD%A6%E7%AB%99\"]\', \'2\', \'12:09:00\', \'02:05:00\', \'22.972283\', \'114.724041\', \'441323\', \'1\', null, \'2020-11-05 21:59:42\', \'2020-11-05 21:59:42\');');
        DB::insert('INSERT INTO `users` VALUES (\'4\', \'test3\', null, null, null, \'$2y$10$9GLCdAQfSSi/Xe9jc/QSJOslsT16XwXpzOQNyJU57rp8y4LhcJnf6\', \'惠阳测试店\', \'13427969604\', \'广东省惠州市惠阳区秋长街道鸡婆岭\', \'[\"%E7%81%AB%E8%BD%A6%E7%AB%99\"]\', \'3\', \'12:07:00\', \'12:10:00\', \'22.889709\', \'114.440267\', \'441303\', \'1\', null, \'2020-11-05 22:02:15\', \'2020-11-05 22:02:15\');');
    }
}
