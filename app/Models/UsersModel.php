<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsersModel extends Authenticatable implements JWTSubject
{
   protected $fillable = [
       'username',
       'password',
       'nickname',
       'phone',
       'address',
       'tags',
       'rate',
       'start_time',
       'end_time',
       'latitude',
       'longitude',
       'region_id'
   ];

    protected $table = 'users';

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'test' => '2131321'
        ];
    }

    protected function getTagsAttribute($value)
    {
        $tags = json_decode($value, true);
        if (!$tags) return [];
        $res =  array_map(function ($item) {
            return urldecode($item);
        }, $tags);

        return $res;
    }

    protected function setTagsAttribute($value)
    {
        $value = array_map(function ($item) {
            return urlencode($item);
        }, $value);

        $tags = json_encode($value);
        $this->attributes['tags'] = $tags;
    }

    // 角色
    public function roles()
    {
        return $this->hasManyThrough(
            RolesModel::class,
            UserRolesModel::class,
            'user_id', // 用户表外键->存在中间表中
            'id', // 目标表键名
            'id', //  本地名键名
            'role_id' // 中间表关联目标表的键名
        );
    }

    public function region()
    {
        return $this->hasOne(RegionsModel::class, 'id', 'region_id');
    }

    /**
     * 门店图片
     * @param $key
     */
    public function getBannersAttribute(): array
    {
        $returnData = [];
        $id = $this->id;
        $UserBanners = UserBannersModel::where('user_id', $id)->get();
        foreach ($UserBanners as $UserBanner) {
            $item = [];
            $item['id'] = $UserBanner->album->id;
            $item['url'] =$UserBanner->album->url;
            $returnData[] = $item;
        }
        return $returnData;
    }
}
