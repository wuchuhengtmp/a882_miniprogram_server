<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WechatApi\ConfigShowRequest;
use App\Models\AlbumsModel;

class ConfigsController extends Controller
{
    public function show($key, ConfigShowRequest $request)
    {
        $value = getConfigByKey($key);
        // 图片配置
        if (in_array($key, ['BACK_LOGO'])) {
            $Album = AlbumsModel::where('id', $value)->first();
            return $this->successResponse([
                'id' => $Album->id,
                'url' => $Album->url
            ]);
        }
        return $this->successResponse(['value' => $value]);
    }
}
