<?php

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Api\PermissionsController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BrandsModel;
use App\Http\Requests\Admin\ManagementBrandBreateRequest;
use App\Http\Requests\Admin\ManagementBrandEditRequest;

class BrandsController extends Controller
{
    private $_brandsModel;

    public function __construct(BrandsModel $brandsModel)
    {
        $this->_brandsModel = $brandsModel;
    }

    public function index()
    {
        $brands = $this->_brandsModel
            ->select('id', 'name')
            ->get();
        return $this->successResponse($brands->toArray());
    }

    public function create(ManagementBrandBreateRequest $request)
    {
         $brandsModel = $this->_brandsModel;
         $brandsModel->name = $request->input('name');
         if ($brandsModel->save()) {
             return $this->successResponse();
         }
         throw new InnerErrorException();
    }

    public function edit(ManagementBrandEditRequest $request)
    {
        $Brand = $this->_brandsModel->where('id', $request->route('id'))->first();
        $Brand->name = $request->input('name');
        if ($Brand->save()) {
            return $this->successResponse();
        } else {
            throw new InnerErrorException();
        }
    }
}
