<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberCouponsModel extends Model
{
    protected $table = 'member_coupons';

    protected $fillable = [
        'cost',
        'name',
        'des',
        'expired_at',
        'album_id',
        'is_alert'
    ];
}
