<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GoodsModel;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use App\Http\Requests\WechatApi\ShopGoodsIndexRequest as IndexRequest;

class ShopGoodsController extends Controller
{
    /**
     *  获取门店商品
     */
    public function index($id, IndexRequest $request)
    {
        $result = $request->input('result', 10);
        $returnData = [
            'items' => [],
            'total' => 0
        ];
        $GoodsQuery = GoodsModel::where('user_id',  $id)
            ->orderBy('id', 'desc')
            ->where('status', 1)
            ->where('total', '>', 0);
        // 车型过滤
        if ($request->has('categoryId')) {
            $categoryId = $request->input('categoryId');
            $GoodsQuery = $GoodsQuery->where('category_id', $categoryId);
        }
        // 品牌过滤
        if ($request->has('brandId')) {
            $brandId = $request->input('brandId');
            $GoodsQuery = $GoodsQuery->where('brand_id', $brandId);
        }
        // 标签过滤
        if ($request->has('tagId')) {
            $tagId = $request->input('tagId');
            $GoodsQuery = $GoodsQuery->whereJsonContains('tag_ids',$tagId);
        }
        // 价格区间过滤
        if ($request->has('costRange')) {
            $costRanges = explode(',', $request->input('costRange'));
            // 以下价格
            if (count($costRanges) === 1) {
                $GoodsQuery = $GoodsQuery->where('cost', '<=', $costRanges[0]);
            } else if (count($costRanges) === 2) {
                // 区间价格
                $GoodsQuery = $GoodsQuery->where('cost', '>=', $costRanges[0]);
                $GoodsQuery = $GoodsQuery->where('cost', '<=', $costRanges[1]);
            }
        }
        $Goods = $GoodsQuery->paginate($result);
        $Items = $Goods->items();
        $returnData['total'] = $Goods->total();
        foreach ($Items as &$Item) {
            $tmp = [];
            $tmp['id'] = $Item->id;
            $tmp['name'] = $Item->name;
            $tmp['banner'] = $Item->banner;
            $tmp['tags'] = $Item->tags;
            $tmp['brand_id'] = $Item->brand_id;
            $tmp['cost'] = $Item->cost;
            $tmp['insurance_cost'] = $Item->insurance_cost;
            $tmp['brand'] = $Item->brand;
            $returnData['items'][] = $tmp;
        }
        return $this->successResponse($returnData);
    }
}
