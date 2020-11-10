<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayNoticesModel extends Model
{
    protected $table = 'pay_notices';

    protected $fillable = [
        'title',
        'content',
        'icon_id'
    ];

    public function getIconAttribute()
    {
        $id = $this->icon_id;
        $Album = AlbumsModel::where('id', $id)->first();
        return [
            'id' => $id,
            'url' => $Album->url
        ];
    }
}
