<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoresModel;

class CategoresController extends Controller
{
    public function index()
    {
        $Categores = CategoresModel::select( 'id', 'name' )->get();
        return $this->successResponse($Categores->toArray());
    }
}
