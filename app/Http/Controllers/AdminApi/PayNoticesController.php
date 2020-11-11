<?php

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PayNoticesDestroyRequest;
use App\Models\AlbumsModel;
use App\Models\GoodsTagsModel;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PayNoticesCreateRequest;
use App\Models\PayNoticesModel;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\PayNoticesEditRequest;

class PayNoticesController extends Controller
{
    public function index(PayNoticesModel $payNoticesModel)
    {
        $PayNotices = $payNoticesModel
            ->select( 'id', 'title', 'content', 'icon_id' )->get()
            ->append('icon')
            ->makeHidden('icon_id');
        return $this->successResponse($PayNotices->toArray());
    }

    public function create(PayNoticesCreateRequest $request, PayNoticesModel $payNoticesModel, AlbumsModel $albumsModel)
    {
        $icon = $request->input('icon');
        $payNoticesModel->title = $request->input('title');
        $payNoticesModel->content = $request->input('content');
        $payNoticesModel->icon_id = $icon;
        DB::beginTransaction();
        $payNoticesModel->save();
        AlbumsModel::withTrashed()->where('id', $icon)->restore();
        try { Db::commit(); } catch (\Exception $e) {
            DB::rollBack();
            throw new InnerErrorException('添加失败,内部错误', 40002, 4);
        }
        return $this->successResponse([
            'id' => $payNoticesModel->id
        ]);
    }

    public function edit($id, PayNoticesModel $payNoticesModel, PayNoticesEditRequest $request)
    {
        $iconId = $request->input('icon');
        $PayNotice = $payNoticesModel->where('id', $id)->first();
        $PayNotice->title = $request->input('title');
        $PayNotice->content= $request->input('content');
        $oldIconId = $PayNotice->icon_id;
        $PayNotice->icon_id = $request->input('icon');
       DB::beginTransaction();
       AlbumsModel::where('id', $oldIconId)->delete();
       $PayNotice->save();
       AlbumsModel::withTrashed()->where('id', $iconId)->restore();
        try {
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new InnerErrorException('编辑失败,内部错误', 40002, 4);
        }
        return $this->successResponse();
    }

    public function destroy($id, PayNoticesDestroyRequest $request, PayNoticesModel $payNoticesModel)
    {
        $PayNotice = $payNoticesModel->where('id', $id)->first();
        DB::beginTransaction();
        $albumId = $PayNotice->notice_id;
        $PayNotice->delete();
        AlbumsModel::where('id', $albumId)->delete();
        try{
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            throw new InnerErrorException('删除失败');
        }
        return $this->successResponse();
    }
}
