<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WechatApi\ShopsShowRequest;
use App\Http\Services\ShopService;
use App\Models\RegionsModel;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use App\Http\Requests\WechatApi\ShopIndexShopsRequest;

class ShopsController extends Controller
{
    /**
     *  获取城市门店 列表
     * @param ShopIndexShopsRequest $request
     * @param RegionsModel $regionsModel
     * @param ShopService $shopService
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function indexShops(
        ShopIndexShopsRequest $request,
        RegionsModel $regionsModel,
        ShopService $shopService
    )
    {
        $cityName = $request->route('cityName');
        $City = $regionsModel->where('name', 'like', "$cityName%")
            ->select('id')
            ->first();
        $parentId = $City->id;
        $Areas = $regionsModel->where('parent_id', $parentId)
            ->get();
        $returnData = [];
        foreach ($Areas as $Area) {
            $areaDetail = [
                'id' => $Area->id,
                'name' => $Area->name,
                'shopItems' => $shopService->getShopSByAreaId($Area->id)
            ];
            $returnData[] = $areaDetail;
        }
        return $this->successResponse($returnData);
    }

    /**
     * 门店详情
     * @param $id
     * @param ShopsShowRequest $request
     * @param UsersModel $usersModel
     */
    public function show(
        $id,
        ShopsShowRequest $request,
        UsersModel $usersModel
    )
    {
        $Shop = $usersModel->where('id', $id)
            ->first();
        return $this->successResponse([
            'id' => $Shop->id,
            'banners' => $Shop->banners,
            'rate' => $Shop->rate,
            'nickname' => $Shop->nickname,
            'address' => $Shop->address,
            'latitude' => $Shop->latitude,
            'longitude' => $Shop->longitude,
            'phone' => $Shop->phone
        ]);

    }
}
