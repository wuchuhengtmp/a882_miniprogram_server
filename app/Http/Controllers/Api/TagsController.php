<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoodsTagsModel;

class TagsController extends Controller
{
    public function index()
    {
        $Tags = GoodsTagsModel::select('id', 'name')->get();
        return $this->successResponse($Tags->toArray());
    }
}
