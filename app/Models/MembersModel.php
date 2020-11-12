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
        'session_key'
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
}
