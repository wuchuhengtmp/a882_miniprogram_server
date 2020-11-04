<?php

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FqUpdateRequest;
use Illuminate\Http\Request;
use App\Models\FqModel;
use App\Http\Requests\Admin\FqCreateRequest;
use App\Http\Requests\Admin\FqDeleteRequest;

class FqController extends Controller
{
    public function index(Request $request)
    {
        $result = $request->input('result', 10);
        $Page = FqModel::orderBy('order_no', 'desc')->paginate($result);
        $Items = $Page->items();
        foreach ($Items as &$Item ) {
            $Item = $Item->toArray();

        }
        return $this->successResponse([
            'items' => $Items,
            'total' => $Page->total()
        ]);
    }

    public function create(FqCreateRequest $request, FqModel $fqModel)
    {
        $fqModel->title = $request->input('title');
        $fqModel->order_no = $request->input('order_no');
        $fqModel->content = $request->input('content');
        if ($fqModel->save()) {
            return $this->successResponse(['id' => $fqModel->id]);
        }
        throw new InnerErrorException('内部异常，添加失败', 40002, 4);
    }

    public function destroy($id, FqDeleteRequest $request, FqModel $fqModel)
    {
        $Fq = $fqModel->where('id', $id)->first();
        if ( $Fq->delete() ) {
            return $this->successResponse();
        }
        throw new InnerErrorException();
    }

    public function update($id, FqUpdateRequest $request, FqModel $fqModel )
    {
        $Fq  = $fqModel->where('id', $id)->first();
        $Fq->title = $request->input('title');
        $Fq->content = $request->input('content');
        $Fq->order_no = $request->input('order_no');
        if ($Fq->save()) return $this->successResponse();
        throw  new InnerErrorException('内部错误', 40002, 4);
    }
}
