<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Controller;
use App\Models\MembersModel;
use Illuminate\Http\Request;
use EasyWeChat\Factory;
use App\Http\Requests\WechatApi\AuthenticationsCreateRequest as CreateRequest;
use App\Http\Services\WechatAuthenticationsService;
use App\Models\UsersModel;

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
        WechatAuthenticationsService $authenticationsService,
        UsersModel $usersModel,
        MembersModel $membersModel
    )
    {
        $code = $request->input('code');
        $app = $authenticationsService->getAppInstance();
        $result = $app->auth->session($code);
        $openIdKey = 'openid';
        if (!array_key_exists($openIdKey, $result)) throw new InnerErrorException('无效code, 登录失败', 40002, 4);
        $openId = $result[$openIdKey];
        $sessionKey = $result['session_key'];
        $hasUser = $membersModel->where('open_id', $openId)->first();
        if (!$hasUser) {
            // 新建用户
            $membersModel->avatar_url = $request->input('avatarUrl');
            $membersModel->city = $request->input('city');
            $membersModel->country = $request->input('country');
            $membersModel->gender = $request->input('gender');
            $membersModel->language = $request->input('language');
            $membersModel->nickName = $request->input('nickName');
            $membersModel->province = $request->input('province');
            $membersModel->session_key = $sessionKey;
            $membersModel->open_id = $openId;
            $membersModel->platform = 'wechat';
            $membersModel->member_role_id = 1;



            if ( $membersModel->save() ) {
                return $this->successResponse();
            }
            throw new InnerErrorException('内部错误', 40002, 4);
        }
        $user = MembersModel::where('open_id', $openId)->first();
        $token = auth('member')->login($user);
        return $this->successResponse(['token' => $token]);
    }
}
