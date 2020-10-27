<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class AlbumsModel extends Model
{
    use SoftDeletes;

    protected $table = 'albums';

    protected $fillable = [
        'path',
        'disk'
    ];

    public function getUrlAttribute($key)
    {
        return Storage::disk($this->disk)->url($this->path);
    }
}
