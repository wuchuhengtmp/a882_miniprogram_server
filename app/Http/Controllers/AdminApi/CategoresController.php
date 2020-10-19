<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoresModel;
use App\Exceptions\InnerErrorException;
use App\Exceptions\BaseException;
use App\Http\Requests\Admin\ManagementCategoryCreateRequest;

class CategoresController extends Controller
{
    private $_categoresModel;

    private $_request;

    public function __construct(
        CategoresModel $categoresModel,
        Request $request
    )
    {
        $this->_request = $request;
        $this->_categoresModel = $categoresModel;
    }

    public function index()
    {
        $categoryCo = $this->_categoresModel
            ->select('id', 'name', 'order_no')
            ->get();
        return $this->successResponse($categoryCo ->toArray());
    }

    public function update($id)
    {
        $categoryItem = $this->_categoresModel->where('id', $id)
            ->first();
        $categoryItem->name = $this->_request->input('name');
       if($categoryItem->save()) {
           return $this->successResponse();
       } else {
           throw new InnerErrorException();
       }
    }

    public function create(ManagementCategoryCreateRequest $request)
    {
        $categores =  $this->_categoresModel;
        $categores->name = $this->_request->input('name');
        if ($categores->save()) {
            return $this->successResponse();
        }  else {
            throw new InnerErrorException();
        }
    }
}
