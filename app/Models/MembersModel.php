<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class MembersModel extends Authenticatable implements JWTSubject
{
    protected $table = 'members';

    protected $fillable = [
        'avatar_url',
        'city',
        'country',
        'gender',
        'language',
        'nickName',
        'province',
        'open_id',
        'session_key',
        'member_role_id',
        'platform'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'from' => 'member'
        ];
    }

    public function getMemberRoleAttribute()
    {
        $MemberRole = MemberRolesModel::where('id', $this->member_role_id)->first();
        return [
            'id' => $MemberRole->id,
            'name' => $MemberRole->name
        ];
    }

    public function getGenderAttribute($value)
    {
        $value = (int) $value;
        $returnData = [
            'id' => $value,
            'name' => '未知'
        ];
        switch ($value) {
            case 0:
                $returnData['name'] = '女';
                break;
            case 1:
                $returnData['name'] = '男';
        }
        return $returnData;
    }

}
