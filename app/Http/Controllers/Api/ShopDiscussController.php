<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\WechatApi\ShopDiscussesIndexRequest;

class ShopDiscussController extends Controller
{
    /**
     *  评论列表
     */
    public function index(ShopDiscussesIndexRequest $request)
    {
        $result = $request->input('result', 10);
        //:xxx 门店评论
        $item = [
        ];
        $returnData = [
            'items' => [],
            'total' => 100
        ];
//        return $this->successResponse($returnData);
        for($i = 0; $i < $result; $i += 1) {
            $returnData['items'][] = [
                'name' => "我的名字" . rand(1, 100),
                'date' => rand(1, 12) . "/" . rand(1, 30),
                'content' => (function() {
                    $str = '';
                    for($i = rand(1, 5); $i <= 5; $i += 1) $str .= "这是评论内容";
                    return $str;
                    })(),
                'rate' => rand(0, 5),
                'avatar' => "http://a882.xinwangd.cn/storage/JrPJpNpuFF8vo8kAfPiHM3xZBCuFKHdK7vTWuSIV.jpeg",
            ];
        }
        return $this->successResponse($returnData);
    }
}
