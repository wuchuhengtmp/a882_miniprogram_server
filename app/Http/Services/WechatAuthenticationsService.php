<?php


namespace App\Http\Services;


use EasyWeChat\Factory;

class WechatAuthenticationsService
{
    private $_appInstance;

    public function getAppInstance()
    {
        if (!$this->_appInstance) {
            $appId =  getConfigByKey('MINI_PROGRAM_APP_ID');
            $appSecret = getConfigByKey('MINI_PROGRAM_APP_SECRET');
            $config = [
                'app_id' => $appId,
                'secret' => $appSecret,

                // 下面为可选项
                // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
                'response_type' => 'array',

                'log' => [
                    'level' => 'debug',
                    'file' => __DIR__.'/wechat.log',
                ],
            ];
            $this->_appInstance = Factory::miniProgram($config);
        }

        return $this->_appInstance;
    }
}
