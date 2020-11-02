<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
// 微信小程序接口
Route::prefix('wechat')->name('api.wechat.')->group(function() {
    Route::post('authentications', [\App\Http\Controllers\Api\Authontication::class, 'create']);
});

// 后台接口
Route::prefix('admin')->name('api.admin.')->group(function() {
    // 登录
    Route::post('authentications', [\App\Http\Controllers\AdminApi\AuthenticationsController::class, 'create']);
    // 账号信息
    Route::middleware('auth:api', \App\Http\Middleware\PermissionValidateMiddleware::class)->group(function() {
        // 创建门店
        Route::post('users', [\App\Http\Controllers\AdminApi\UsersController::class, 'create']);
        // 门店列表
        Route::get('users', [\App\Http\Controllers\AdminApi\UsersController::class, 'index']);
        // 修改门店状态
        Route::put('users/{id}/isDisable', [\App\Http\Controllers\AdminApi\UsersController::class, 'updateIsDisable']);
        // 修改门店
        Route::patch('users/{id}', [\App\Http\Controllers\AdminApi\UsersController::class, 'update']);
        // 获取门店名列表
        Route::get('users/shopNames', [\App\Http\Controllers\AdminApi\UsersController::class, 'showShopName']);
        // 获取当前登录信息
        Route::get('users/me', [\App\Http\Controllers\AdminApi\UsersController::class, 'show']);
        // 获取车型列表
        Route::get('management/categores', [\App\Http\Controllers\AdminApi\CategoresController::class, 'index']);
        // 添加车型
        Route::post('management/categores', [\App\Http\Controllers\AdminApi\CategoresController::class, 'create']);
        // 更新车型
        Route::patch('management/categores/{id}', [\App\Http\Controllers\AdminApi\CategoresController::class, 'update']);
        // 添加品牌
        Route::post('management/brands', [\App\Http\Controllers\AdminApi\BrandsController::class, 'create']);
        // 修改品牌
        Route::patch('management/brands/{id}', [\App\Http\Controllers\AdminApi\BrandsController::class, 'edit']);
        // 获取品牌列表
        Route::get('management/brands', [\App\Http\Controllers\AdminApi\BrandsController::class, 'index']);
        // 获取商品标签列表
        Route::get('management/goodsTags', [\App\Http\Controllers\AdminApi\GoodstagsController::class, 'index']);
        // 添加商品标签
        Route::post('management/goodsTags', [\App\Http\Controllers\AdminApi\GoodstagsController::class, 'create']);
        // 修改商品标签
        Route::patch('management/goodsTags/{id}', [\App\Http\Controllers\AdminApi\GoodstagsController::class, 'edit']);
        // 上传图片
        Route::post('albums', [\App\Http\Controllers\AdminApi\AlbumsController::class, 'create']);
        // 获取配置
        Route::get('configs', [\App\Http\Controllers\AdminApi\ConfigController::class, 'index']);
        // 获取公网ip
        Route::get('ip', [\App\Http\Controllers\AdminApi\IPController::class, 'show']);
        // 删除门店的图片
        Route::delete('userBanners/{id}', [\App\Http\Controllers\AdminApi\UserBannersController::class, 'destroy']);
        // 添加车子
        Route::post('goods', [\App\Http\Controllers\AdminApi\GoodsController::class, 'created']);
        // 更新车子上下架状态
        Route::put('goods/{id}/status', [\App\Http\Controllers\AdminApi\GoodsController::class, 'updateStatus']);
        // 编辑车子
        Route::put('goods/{id}', [\App\Http\Controllers\AdminApi\GoodsController::class, 'update'])->middleware([
            \App\Http\Middleware\CheckAdminOrShopAuthMiddleware::class
        ]);
        // 获取车子列表
        Route::get('goods', [\App\Http\Controllers\AdminApi\GoodsController::class, 'index']);
        // 修改车子上下架状态
        Route::get('goods/status', [\App\Http\Controllers\AdminApi\GoodsController::class, 'showStatus'])->middleware([
            \App\Http\Middleware\CheckAdminOrShopAuthMiddleware::class
        ]);
        // 添加幻灯片
        Route::post('slides', [\App\Http\Controllers\AdminApi\SlidesController::class, 'create']);
        // 获取幻灯片
        Route::get('slides', [\App\Http\Controllers\AdminApi\SlidesController::class, 'index']);
    });

});

