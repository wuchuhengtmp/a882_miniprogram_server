<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
