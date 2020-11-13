<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberRolesModel extends Model
{
    protected $table = 'member_roles';

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
