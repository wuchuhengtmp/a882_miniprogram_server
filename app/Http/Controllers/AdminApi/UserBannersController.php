<?php

/**
 *  门店banner图片管理
 */

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Controller;
use Faker\Calculator\Inn;
use Illuminate\Http\Request;
use App\Models\UserBannersModel;
use Illuminate\Support\Facades\DB;


class UserBannersController extends Controller
{

    private $_UserBannerModel;

    public function __construct(
        UserBannersModel $userBannersModel
    )
    {
        $this->_UserBannerModel = $userBannersModel;
    }

    // 删除
    public function destroy()
    {
        $id = \request()->route('id');
        $UserBanner = $this->_UserBannerModel->where('id', $id)->first();
        if (!$UserBanner) throw new InnerErrorException('图上不存在');
        DB::beginTransaction();
        if (
            $UserBanner->album->delete() &&
            $UserBanner->delete()
        ) {
            DB::commit();
            return $this->successResponse();
        }
        DB::rollBack();
        throw new InnerErrorException();
    }
}
