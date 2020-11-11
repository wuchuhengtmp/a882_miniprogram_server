<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `permissions` VALUES (\'1\', \'App_Http_Controllers_AdminApi_UsersController\', \'create\', \'创建门店\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'2\', \'App_Http_Controllers_AdminApi_UsersController\', \'index\', \'门店列表\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'3\', \'App_Http_Controllers_AdminApi_UsersController\', \'updateIsDisable\', \'修改门店状态\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'4\', \'App_Http_Controllers_AdminApi_UsersController\', \'update\', \'修改门店\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'5\', \'App_Http_Controllers_AdminApi_UsersController\', \'showShopName\', \'获取门店名列表\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'6\', \'App_Http_Controllers_AdminApi_UsersController\', \'show\', \'获取当前登录信息\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'7\', \'App_Http_Controllers_AdminApi_CategoresController\', \'index\', \'获取车型列表\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'8\', \'App_Http_Controllers_AdminApi_CategoresController\', \'create\', \'添加车型\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'9\', \'App_Http_Controllers_AdminApi_CategoresController\', \'update\', \'更新车型\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'10\', \'App_Http_Controllers_AdminApi_BrandsController\', \'create\', \'添加品牌\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'11\', \'App_Http_Controllers_AdminApi_BrandsController\', \'edit\', \'修改品牌\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'12\', \'App_Http_Controllers_AdminApi_BrandsController\', \'index\', \'获取品牌列表\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'13\', \'App_Http_Controllers_AdminApi_GoodstagsController\', \'index\', \'获取商品标签列表\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'14\', \'App_Http_Controllers_AdminApi_GoodstagsController\', \'create\', \'添加商品标签\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'15\', \'App_Http_Controllers_AdminApi_GoodstagsController\', \'edit\', \'修改商品标签\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'16\', \'App_Http_Controllers_AdminApi_AlbumsController\', \'create\', \'上传图片\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'17\', \'App_Http_Controllers_AdminApi_ConfigController\', \'index\', \'获取配置\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'18\', \'App_Http_Controllers_AdminApi_IPController\', \'show\', \'获取公网ip\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'19\', \'App_Http_Controllers_AdminApi_UserBannersController\', \'destroy\', \'删除门店的图片\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'20\', \'App_Http_Controllers_AdminApi_GoodsController\', \'created\', \'添加车子\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'21\', \'App_Http_Controllers_AdminApi_GoodsController\', \'updateStatus\', \'更新车子上下架状态\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'22\', \'App_Http_Controllers_AdminApi_GoodsController\', \'update\', \'编辑车子\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'23\', \'App_Http_Controllers_AdminApi_GoodsController\', \'index\', \'获取车子列表\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'24\', \'App_Http_Controllers_AdminApi_GoodsController\', \'showStatus\', \'修改车子上下架状态\', \'2020-11-01 16:02:18\', \'2020-11-01 16:02:18\');');
        DB::insert('INSERT INTO `permissions` VALUES (\'25\', \'App_Http_Controllers_AdminApi_SlidesController\', \'create\', \'添加幻灯片\', null, null);');
        DB::insert('INSERT INTO `permissions` VALUES (\'26\', \'App_Http_Controllers_AdminApi_SlidesController\', \'index\', \'获取幻灯片\', null, null);');
        DB::insert('INSERT INTO `permissions` VALUES (\'27\', \'App_Http_Controllers_AdminApi_SlidesController\', \'destroy\', \'删除幻灯片\', null, null);');
        DB::insert('INSERT INTO `permissions` VALUES (\'28\', \'App_Http_Controllers_AdminApi_SlidesController\', \'update\', \'更新幻灯片\', null, null);');
        DB::insert('INSERT INTO `permissions` VALUES (\'29\', \'App_Http_Controllers_AdminApi_ClausesController\', \'index\', \'获取列表\', null, null);');
        DB::insert('INSERT INTO `permissions` VALUES (\'30\', \'App_Http_Controllers_AdminApi_ClausesController\', \'update\', \'修改条款\', null, null);');
        DB::insert('INSERT INTO `permissions` VALUES (\'31\', \'App_Http_Controllers_AdminApi_FqController\', \'index\', \'获取常见问题列表\', null, null);');
        DB::insert('INSERT INTO `permissions` VALUES (\'32\', \'App_Http_Controllers_AdminApi_FqController\', \'create\', \'添加常见问题\', null, null);');
        DB::insert('INSERT INTO `permissions` VALUES (\'33\', \'App_Http_Controllers_AdminApi_FqController\', \'update\', \'编辑常见问题\', null, null);');
        DB::insert('INSERT INTO `permissions` VALUES (\'34\', \'App_Http_Controllers_AdminApi_FqController\', \'delete\', \'删除常见问题\', null, null);');
        DB::insert('INSERT INTO `permissions` VALUES (\'35\', \'App_Http_Controllers_AdminApi_ConfigController\', \'show\', \'获取单个配置\', null, null);');
        DB::insert('INSERT INTO `permissions` VALUES (\'36\', \'App_Http_Controllers_AdminApi_ConfigController\', \'update\', \'修改配置\', null, null);');
        DB::insert('INSERT INTO `permissions` VALUES (\'37\', \'App_Http_Controllers_AdminApi_PayNoticesController\', \'create\', \'添加支付须知\', null, null);');
    }
}
