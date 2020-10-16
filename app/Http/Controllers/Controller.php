<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * @param null $data
     * @param int $showType 前端处理方式  0 silent; 1 message.warn; 2 message.error; 4 notification; 9 page
     */
    public function successResponse($data = null, $showType  = 0)
    {
        $returnData = [
            'success' => true
        ];
        if ($data) $returnData += ['data' => $data];
        if ($showType !== 0) $returnData += ['showType' => $showType];
        return response($returnData);
    }
}
