<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConfigsModel;

class ConfigController extends Controller
{
    private $_ConfigModel;

    public function __construct(
        ConfigsModel $_ConfigModel
    )
    {
        $this->_ConfigModel = $_ConfigModel;
    }

    public function index()
    {
        $ConfigModel = $this->_ConfigModel;
        $configs = $ConfigModel->select('id', 'name', 'value')->get();
        return $this->successResponse($configs->toArray());
    }
}
