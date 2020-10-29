<?php

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GoodsCreateRequest as CreateRequest;
use App\Http\Requests\Admin\GoodsShowStatusRequest;
use App\Http\Services\AuthService;
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
}
