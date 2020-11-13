<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponsModel extends Model
{
    protected $table = 'coupons';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'cost',
        'name',
        'des',
        'expired_day',
        'is_use',
        'give_type',
        'album_id',
        'is_alert'
    ];

    public function getBannerAttribute()
    {
        $Album = AlbumsModel::where('id', $this->album_id)->first();
        return [
            'id' => $Album->id,
            'url' => $Album->url
        ];
    }
}
