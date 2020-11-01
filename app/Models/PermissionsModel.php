<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionsModel extends Model
{
    protected $table = 'permissions';

    protected $fillable = [
        'controller',
        'method',
        'note'
    ];
}
