<?php

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Controller;
use App\Models\AlbumsModel;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SlideCreateRequest;
use App\Models\SlidesModel;

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
}
