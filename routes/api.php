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
    Route::middleware('auth:api')->group(function() {
        // 门店管理
        Route::post('users', [\App\Http\Controllers\AdminApi\UsersController::class, 'create']);
        Route::get('users', [\App\Http\Controllers\AdminApi\UsersController::class, 'index']);
        Route::put('users/{id}/isDisable', [\App\Http\Controllers\AdminApi\UsersController::class, 'updateIsDisable']);
        Route::patch('users/{id}', [\App\Http\Controllers\AdminApi\UsersController::class, 'update']);
        Route::get('users/shopNames', [\App\Http\Controllers\AdminApi\UsersController::class, 'showShopName']);

        Route::get('users/me', [\App\Http\Controllers\AdminApi\UsersController::class, 'show']);
        Route::get('management/categores', [\App\Http\Controllers\AdminApi\CategoresController::class, 'index']);
        Route::post('management/categores', [\App\Http\Controllers\AdminApi\CategoresController::class, 'create']);
        Route::patch('management/categores/{id}', [\App\Http\Controllers\AdminApi\CategoresController::class, 'update']);
        // 品牌分类管理
        Route::post('management/brands', [\App\Http\Controllers\AdminApi\BrandsController::class, 'create']);
        Route::patch('management/brands/{id}', [\App\Http\Controllers\AdminApi\BrandsController::class, 'edit']);
        Route::get('management/brands', [\App\Http\Controllers\AdminApi\BrandsController::class, 'index']);
        // 商品标签
        Route::get('management/goodsTags', [\App\Http\Controllers\AdminApi\GoodstagsController::class, 'index']);
        Route::post('management/goodsTags', [\App\Http\Controllers\AdminApi\GoodstagsController::class, 'create']);
        Route::patch('management/goodsTags/{id}', [\App\Http\Controllers\AdminApi\GoodstagsController::class, 'edit']);

        // 上传相册
        Route::post('albums', [\App\Http\Controllers\AdminApi\AlbumsController::class, 'create']);

        // 配置
        Route::get('configs', [\App\Http\Controllers\AdminApi\ConfigController::class, 'index']);

        // ip
        Route::get('ip', [\App\Http\Controllers\AdminApi\IPController::class, 'show']);

        // 删除门店的图片
        Route::delete('userBanners/{id}', [\App\Http\Controllers\AdminApi\UserBannersController::class, 'destroy']);

        // 添加商品
        Route::post('goods', [\App\Http\Controllers\AdminApi\GoodsController::class, 'created']);
        // 商品列表
        Route::get('goods', [\App\Http\Controllers\AdminApi\GoodsController::class, 'index']);
        // 上下架状态
        Route::get('goods/status', [\App\Http\Controllers\AdminApi\GoodsController::class, 'showStatus'])->middleware([
            \App\Http\Middleware\CheckAdminOrShopAuthMiddleware::class
        ]);
    });

});

