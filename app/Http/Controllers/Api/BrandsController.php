<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BrandsModel;

class BrandsController extends Controller
{
    public function index()
    {
        $Brands = BrandsModel::select('id', 'name')->get();
        return $this->successResponse($Brands->toArray());
    }
}
