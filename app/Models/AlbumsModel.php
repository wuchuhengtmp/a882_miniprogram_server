<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlbumsModel extends Model
{
    use SoftDeletes;

    protected $table = 'albums';

    protected $fillable = [
        'path',
        'disk'
    ];
}
