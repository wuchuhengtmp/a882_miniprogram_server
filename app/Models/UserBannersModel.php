<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBannersModel extends Model
{
    protected $table = 'user_banners';

    protected $fillable = [
        'user_id',
        'album_id'
    ];

    public function album()
    {
        return $this->hasOne(AlbumsModel::class, 'id', 'album_id');
    }
}
