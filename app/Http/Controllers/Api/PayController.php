<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Auth;


class PayController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $app = \EasyWeChat::payment(); // 微信支付
        $jssdk = $app->jssdk;


        $result = $app->order->unify([
            'body' => '腾讯充值中心-QQ会员充值',
            'out_trade_no' => date('ymdhsi', time()) . explode('.', microtime(true))[1],
            'total_fee' => 1,
            'trade_type' => 'JSAPI', // 请对应换成你的支付方式对应的值类型
            'openid' => $user->open_id
        ]);

        if ($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS') {
            $prepayId = $result['prepay_id'];
            $config = $jssdk->sdkConfig($prepayId);
            return response($config);

        }
    }
}
