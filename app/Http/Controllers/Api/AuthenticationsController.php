<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EasyWeChat\Factory;
use App\Http\Requests\WechatApi\AuthenticationsCreateRequest as CreateRequest;
use App\Http\Services\WechatAuthenticationsService;

class AuthenticationsController extends Controller
{
    /***
     * 授权
     * @param CreateRequest $request
     * @param WechatAuthenticationsService $authenticationsService
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function create(
        CreateRequest $request,
        WechatAuthenticationsService $authenticationsService
    )
    {
        $code = '013QFc0w3M3WhV2n1c1w31MOwc0QFc0R';
        $app = $authenticationsService->getAppInstance();
        $result = $app->auth->session($code);
        dd($result);
    }
}
