<?php

namespace App\Http\Services;

use App\Exceptions\InnerErrorException;
use App\Models\GoodsModel;
use App\Models\AlbumsModel;
use Illuminate\Support\Facades\DB;

class GoodsService
{
    /**
     * 入库商品
     * @param int $userId
     * @param array $params
     */
     public function createGoodsByUserId(int $userId, array $params) : bool
     {
         $GoodsModel = new GoodsModel();
         $GoodsModel->user_id = $userId;
         $GoodsModel->name = $params['name'];
         $GoodsModel->category_id = $params['category_id'];
         $GoodsModel->brand_id = $params['brand_id'];
         $GoodsModel->cost = $params['cost'];
         $GoodsModel->tag_ids = explode(',', $params['tag_ids']);
         $GoodsModel->total = $params['total'];
         $GoodsModel->banner_id = $params['banner_id'];
         $GoodsModel->insurance_cost = $params['insurance_cost'];
         $GoodsModel->base_cost = $params['base_cost'];
         $GoodsModel->service_cost = $params['service_cost'];
         $GoodsModel->pledge_cost = $params['pledge_cost'];
         $GoodsModel->status = $params['status'];
         DB::beginTransaction();
         try {
             $GoodsModel->save();
             AlbumsModel::withTrashed()
                 ->where('id', $params['banner_id'])
                 ->restore();
             DB::commit();
             return true;
         } catch (\Exception $e) {
             DB::rollBack();
             throw new InnerErrorException("车辆入库到门店id: {$userId}失败", 40002, 4);
         }
     }
}
