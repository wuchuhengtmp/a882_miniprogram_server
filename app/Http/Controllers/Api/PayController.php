<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EasyWeChat\Factory;

class PayController extends Controller
{
    public function create()
    {
        $config = [
        // 必要配置
        'app_id'             => 'wxb0e720433455d030', //小程序 appid
        'mch_id'             => '1604001481', // 商户号
        'key'                => 'dd4b61331704ecf4d4aa1ea6d5d68882',   // 小程序 密钥
            // fsfsadfsfsakjkjkjkjkj312kj2k3jss

        // 如需使用敏感接口（如退款、发送红包等）需要配置 API 证书路径(登录商户平台下载 API 证书)
        'cert_path'          => 'path/to/your/cert.pem', // XXX: 绝对路径！！！！
        'key_path'           => 'path/to/your/key',      // XXX: 绝对路径！！！！

        'notify_url'         => 'https://a882.xinwangd.cn/api/wechat/pay',     // 你也可以在下单时单独设置来想覆盖它
    ];
        $app = Factory::payment($config);
        $result = $app->order->unify([
            'body' => '腾讯充值中心-QQ会员充值',
            'out_trade_no' => '20150806125346',
            'total_fee' => 88,
            'trade_type' => 'JSAPI', // 请对应换成你的支付方式对应的值类型
            'openid' => 'oUpF8uMuAJO_M2pxb1Q9zNjWeS6o',
        ]);
        return $this->successResponse($result);
    }
}
