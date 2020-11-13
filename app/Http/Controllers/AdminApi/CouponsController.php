<?php

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Api\PayController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponsDestroyRequest;
use App\Http\Requests\Admin\CouponsEditRequest;
use App\Models\AlbumsModel;
use App\Http\Requests\Admin\CouponsCreateRequest;
use App\Models\CouponsModel;
use Illuminate\Support\Facades\DB;
use App\Http\Services\CommonService;
use Illuminate\Support\Facades\Hash;
use Prophecy\Exception\Doubler\InterfaceNotFoundException;

class CouponsController extends Controller
{
    public function index(CommonService $commonService)
    {
        $Coupons = CouponsModel::get()
            ->append([
                'banner'
            ])
            ->makeHidden('album_id');
        $Coupons = $Coupons->map(function($item, $key) use($commonService) {
            $commonService->formatCollectionKey($item, 'is_use');
            $commonService->formatCollectionKey($item, 'give_type');
            $commonService->formatCollectionKey($item, 'is_alert');
            $commonService->formatCollectionKey($item, 'expired_day');
            $item->isUse = (bool) $item->isUse;
            $item->isAlert = (bool) $item->isAlert;
            return $item;
        });
        return $this->successResponse($Coupons->toArray());
    }

    /**
     *  优惠卷 +1
     * @param CouponsCreateRequest $request
     * @param CouponsModel $couponsModel
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws InnerErrorException
     */
    public function create(CouponsCreateRequest $request, CouponsModel $couponsModel)
    {
        $albumId = $request->input('banner');
        $couponsModel->cost = $request->input('cost');
        $couponsModel->des = $request->input('des');
        $couponsModel->expired_day = $request->input('expiredDay');
        $couponsModel->give_type = $request->input('giveType');
        $couponsModel->is_use = $request->input('isUse');
        $couponsModel->name = $request->input('name');
        $couponsModel->album_id = $albumId;
        $couponsModel->is_alert = $request->input('isAlert');
        DB::beginTransaction();
        AlbumsModel::withTrashed()->where('id', $albumId)->restore();
        $couponsModel->save();
        try {
           DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            throw new InnerErrorException('内部错误，添加优惠卷失败', 40002, 4);
        }
        return $this->successResponse([
            'id' => $couponsModel->id
        ]);
    }

    /**
     * 修改
     * @param int $id
     * @param CouponsEditRequest $request
     * @param CouponsModel $couponsModel
     */
    public function edit($id, CouponsEditRequest $request, CouponsModel $couponsModel)
    {
        $Coupon = $couponsModel->where('id', $id)->first();
        $olAlbumId = $Coupon->album_id;
        $Coupon->cost = $request->input('cost');
        $Coupon->des = $request->input('des');
        $Coupon->expired_day = $request->input('expiredDay');
        $Coupon->give_type = $request->input('giveType');
        $Coupon->name = $request->input('name');
        $Coupon->album_id= $request->input('banner');
        $Coupon->is_use = $request->input('isUse');
        $Coupon->is_alert = $request->input('isAlert');
        // :xxx 警告，封面共享多个用户，删除的前提是已经没有用户持有这个优惠卷
//        AlbumsModel::where('id', $olAlbumId)->delete();
        DB::beginTransaction();
        AlbumsModel::withTrashed()->where('id', $request->input('banner'))->restore();
        !$Coupon->save();
        try {
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new InnerErrorException('失败，内部错误', 40002, 4);
        }
        return $this->successResponse();
    }

    /**
     *  删除
     * @param $id
     */
    public function destroy($id, CouponsDestroyRequest $request)
    {
        // :xxx 关于封面删除的前提是已经派头出去的用户的存量为0时才能删除封面
       if (CouponsModel::where('id', $id)->delete()) return $this->successResponse();
       throw new InnerErrorException('操作失败', 4000, 4);
    }
}
