<?php

namespace App\Listeners;

use App\Events\CreateMemberEvent;
use App\Models\CouponsModel;
use App\Models\MemberCouponsModel;

class CreateMemberListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param CreateMemberEvent $event
     * @return void
     */
    public function handle(CreateMemberEvent $event)
    {
        $Coupons = CouponsModel::where('give_type', 1)->get();

        foreach ($Coupons as $coupon) {
            $MemberCoupon = new MemberCoucwdcwponsModel();

  `expired_day` int(11) NOT NULL COMMENT '期限时长',
  `is_use` int(11) NOT NULL COMMENT '1使用0禁用',
  `give_type` int(11) NOT NULL COMMENT '发放方式: 1新手发放2手动发放',
  `album_id` int(11) NOT NULL COMMENT '封面的相册id',
  `is_alert` int(11) NOT NULL COMMENT '是否主动提醒',



            $MemberCoupon->cost = $coupon->cost;
            $MemberCoupon->name = $coupon->name;
            $MemberCoupon->des = $coupon->des;
            $MemberCoupon->expired_day = $coupon->expired_day;
            $MemberCoupon->album_id = $coupon->album_id;
            $MemberCoupon->is_alert = $coupon->is_alert;

        }

        dd($Coupons->toArray());
    }
}
