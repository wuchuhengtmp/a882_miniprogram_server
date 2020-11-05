<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SlidesModel;

class SlidesController extends Controller
{
    public function index(SlidesModel $slidesModel)
    {
        $Slides = $slidesModel->get()
            ->makeHidden(['slide_id', 'detail_id'])
            ->append(['slide', 'detail']);
        return $this->successResponse($Slides->toArray());
    }
}

