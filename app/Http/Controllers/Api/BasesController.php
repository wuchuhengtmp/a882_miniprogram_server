<?php

/**
 * 对外公开的信息，如应用名等
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BasesController extends Controller
{
    public function index()
    {
        $name = getConfigByKey('APP_NAME');
        return $this->successResponse([
            'appName' => $name
        ]);
    }
}
