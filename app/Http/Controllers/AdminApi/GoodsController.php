<?php

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GoodsCreateRequest as CreateRequest;
use App\Http\Requests\Admin\GoodsShowStatusRequest;
use App\Http\Requests\Admin\GoodsUpdateRequest;
use App\Http\Requests\Admin\GoodsUpdateStatusRequest;
use App\Http\Services\AuthService;
use App\Models\AlbumsModel;
use App\Models\GoodsModel;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\GoodsService;
use Illuminate\Support\Facades\Request;

class GoodsController extends Controller
{
    private $_GoodsService;

    private $_GoodsModel;

    private $_AuthService;

    public function __construct(
        GoodsService $goodsService,
        GoodsModel $_GoodsModel,
        AuthService $authService
    )
    {
        $this->_AuthService = $authService;
        $this->_GoodsModel = $_GoodsModel;
        $this->_GoodsService = $goodsService;
    }

    public function created(CreateRequest $request)
    {
        if ($request->has('shop_ids')) {
            $shopIds = array_unique(explode(',', $request->input('shop_ids')));
        } else {
            $shopIds[] = Auth::user()->id;
        }
        // 入库
        foreach ($shopIds as $userId) {
            $this->_GoodsService->createGoodsByUserId($userId,
                [
                    'name' => $request->input('name'),
                    'category_id' => $request->input('category_id'),
                    'brand_id' => $request->input('brand_id'),
                    'cost' => $request->input('cost'),
                    'tag_ids' => $request->input('tag_ids'),
                    'total' => $request->input('total'),
                    'banner_id' => $request->input('banner_id'),
                    'insurance_cost' => $request->input('insurance_cost'),
                    'base_cost' => $request->input('base_cost'),
                    'service_cost' => $request->input('service_cost'),
                    'pledge_cost' => $request->input('pledge_cost'),
                    'status' => $request->input('status')
                ]
            );
        }
        return $this->successResponse();
    }

    public function index(Request $request)
    {
        $pageCount = request()->input('result', 1);
        $isAdmin  = Auth::user()->roles()
            ->where('name', 'admin')
            ->first();
        if ($isAdmin) {
            $GoodsModel = $this->_GoodsModel;
        } else {
            $GoodsModel = $this->_GoodsModel
            ->where('user_id', Auth::user()->id);
        }

        $Page = $GoodsModel;
        if (request()->has('name'))  $Page = $Page->where('name', 'like', "%" . request()->input('name') . "%");
        if (request()->has('status'))  {
            switch (request()->input('status')) {
                case 'true' : $Page = $Page->where('status', 1); break;
                case 'false' : $Page = $Page->where('status', 0); break;
            }
        }
        $Page = $Page->paginate($pageCount);
        $items = $Page->items();
        foreach ($items as &$item) {
            $item->makeHidden([
                'tag_ids',
                'category_id',
                'user_id',
                'brand_id',
                'banner_id'
            ]);
            $item->append([
                'tags',
                'category',
                'user',
                'brand',
                'banner'
            ]);
            $createdAt = $item->created_at->format('Y-m-d H:i');
            $item = array_merge($item->toArray(),['created_at' => $createdAt]);
        }

        return $this->successResponse([
            'total' => $Page->total(),
            'items' => $items
        ]);
    }

    /**
     *  上下架列表
     * @param GoodsShowStatusRequest $request
     */
    public function showStatus()
    {
        $isShop = $this->_AuthService->hasRole('shop');
        $GoodsEqualInstance = $this->_GoodsModel;
        if($isShop)  $GoodsEqualInstance = $GoodsEqualInstance->where('user_id', Auth::user()->id);

        $total = $GoodsEqualInstance ->sum('total');
        $onLineTotal = $GoodsEqualInstance
            ->where('status', 1)
            ->sum('total');
        $offLineTotal = $GoodsEqualInstance
            ->where('status', 0)
            ->sum('total');
        return $this->successResponse([
            'total' => $total,
            'onLineTotal' => $onLineTotal,
            'offLineTotal' => $offLineTotal
        ]);
    }

    /**
     * 编辑
     * @param GoodsUpdateRequest $request
     */
    public function update(GoodsUpdateRequest $request)
    {
        $goodsId = $request->route('id');
        $requestParams = $request->validated();
        $Goods = GoodsModel::where('id', $goodsId)->first();
        $oldBannerId = $Goods->banner_id;
        $Goods->banner_id = $requestParams['banner_id'];
        $Goods->base_cost = $requestParams['base_cost'];
        $Goods->brand_id = $requestParams['brand_id'];
        $Goods->category_id = $requestParams['category_id'];
        $Goods->cost = $requestParams['cost'];
        $Goods->insurance_cost = $requestParams['insurance_cost'];
        $Goods->name = $requestParams['name'];
        $Goods->pledge_cost = $requestParams['pledge_cost'];
        $Goods->service_cost = $requestParams['service_cost'];
        $Goods->total = $requestParams['total'];
        $Goods->tag_ids = explode(',',$requestParams['tag_ids']);
        AlbumsModel::where('id', $oldBannerId)->delete();
        // 恢复图片
        AlbumsModel::withTrashed()
            ->where('id', $requestParams['banner_id'])->restore();
        if ($Goods->save()) return $this->successResponse();
        throw new InnerErrorException();
    }

    /**
     *  更新状态
     */
    public function updateStatus(GoodsUpdateStatusRequest $request)
    {
        $Goods = GoodsModel::where('id', $request->route('id'))->first();
        $Goods->status = $request->input('status');
        if ($Goods->save()) return $this->successResponse();
        throw new InnerErrorException();
    }
}
