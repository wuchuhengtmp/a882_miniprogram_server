<?php

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Controller;
use App\Models\GoodsTagsModel;
use App\Http\Requests\Admin\ManagementGoodsTagsCreateRequest as CreateRequest;
use App\Http\Requests\Admin\ManagementBrandEditRequest as EditRequest;


class GoodstagsController extends Controller
{
    private $_GoodsTagsModel;

    public function __construct(GoodsTagsModel $goodsTagsModel)
    {
        $this->_GoodsTagsModel = $goodsTagsModel;
    }

    /**
     * 获取列表
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        $goodsTags = $this->_GoodsTagsModel
            ->select('id', 'name')
            ->get();
        return $this->successResponse($goodsTags->toArray());
    }

    /**
     *  编辑
     * @param EditRequest $request
     */
    public function edit(EditRequest $request)
    {
        $GoodsTags = $this->_GoodsTagsModel
            ->where('id', $request->route('id'))
            ->first();
        $GoodsTags->name = $request->input('name');
        if ($GoodsTags->save()) {
            return $this->successResponse();
        }
        throw new InnerErrorException();
    }

    /**
     * 创建
     * @param CreateRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws InnerErrorException
     */
    public function create(CreateRequest $request)
    {
        $GoodsTag = $this->_GoodsTagsModel;
        $GoodsTag->name = $request->input('name');
        if ($GoodsTag->save()) {
            return  $this->successResponse();
        } else {
            throw new InnerErrorException();
        }
    }
}
