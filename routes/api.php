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
        Route::get('users/me', [\App\Http\Controllers\AdminApi\UsersController::class, 'show']);
        Route::get('management/categores', [\App\Http\Controllers\AdminApi\CategoresController::class, 'index']);
        Route::post('management/categores', [\App\Http\Controllers\AdminApi\CategoresController::class, 'create']);
        Route::patch('management/categores/{id}', [\App\Http\Controllers\AdminApi\CategoresController::class, 'update']);
        // 品牌分类管理
        Route::post('management/brands', [\App\Http\Controllers\AdminApi\BrandsController::class, 'create']);
        Route::patch('management/brands/{id}', [\App\Http\Controllers\AdminApi\BrandsController::class, 'edit']);
        Route::get('management/brands', [\App\Http\Controllers\AdminApi\BrandsController::class, 'index']);
    });
});



