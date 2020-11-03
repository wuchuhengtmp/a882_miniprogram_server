<?php

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SlidesDeleteRequest;
use App\Http\Requests\Admin\SlideUpdateRequest;
use App\Models\AlbumsModel;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SlideCreateRequest;
use App\Models\SlidesModel;
use Illuminate\Support\Facades\DB;

class SlidesController extends Controller
{
    public function create(SlideCreateRequest $request, SlidesModel $slidesModel)
    {
        $slidesModel->slide_id =  $request->input('slide_id');
        $slidesModel->detail_id =  $request->input('detail_id');
        if ($slidesModel->save()) {
            AlbumsModel::withTrashed()->where('id', $slidesModel->slide_id)->restore();
            AlbumsModel::withTrashed()->where('id', $slidesModel->detail_id)->restore();
            return $this->successResponse([
                'id' => $slidesModel->id
            ]);
        }
        throw new InnerErrorException();
    }

    public function index(SlidesModel $slidesModel, Request $request)
    {
        $result = $request->input('result', 10);
        $Page = $slidesModel->orderBy('id', 'desc')->paginate($result);
        $Items = $Page->items();
        foreach ($Items as &$Item) {
            $Item->makeHidden([
                'detail_id',
                'slide_id'
            ]);
            $Item->append([
                'detail',
                'slide'
            ]);
            $Item = $Item->toArray();
        }
        return $this->successResponse([
            'items' => $Items,
            'total' => $Page->total()
        ]);
    }

    public function destroy($id, SlidesModel $slidesModel, SlidesDeleteRequest $request)
    {
        if ($slidesModel->destroyById($id)) return $this->successResponse();
        throw new InnerErrorException();
    }


    /**
     * @return bool|void
     */
    public function update($id, SlidesModel $slidesModel,SlideUpdateRequest $request)
    {
        $Slide = $slidesModel->where('id', $id)->first();
        $oldSlideId = $Slide->slide_id;
        $oldDetailId = $Slide->detail_id;
        $slideId = $request->input('slide_id');
        $detailId = $request->input('detail_id');
        $Slide->slide_id = $slideId;
        $Slide->detail_id = $detailId;
        DB::beginTransaction();
        try{
           $Slide->save();
            AlbumsModel::whereIn('id', [$oldDetailId,$oldSlideId])->delete();
            AlbumsModel::withTrashed()->whereIn('id', [$slideId, $detailId])->restore();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $e->getMessage();
            throw new InnerErrorException($e->getMessage(), 40002, 4);
        }
        return $this->successResponse();
    }
}
