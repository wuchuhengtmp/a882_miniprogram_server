<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlidesModel extends Model
{
    protected $table = 'slides';

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'slide_id',
        'detail_id'
    ];

    public function getSlideAttribute()
    {
        $slideId = $this->attributes['slide_id'];
        $Album  = AlbumsModel::where('id', $slideId)->first();
        return [
            'id' => $Album->id,
            'url' => $Album->url
        ];
    }

    public function getDetailAttribute()
    {
        $detail_id = $this->attributes['detail_id'];
        $Album  = AlbumsModel::where('id', $detail_id)->first();
        return [
            'id' => $Album->id,
            'url' => $Album->url
        ];
    }

    public function destroyById($id)
    {
        $Slide = $this->where('id', $id)->first();
        $slideId = $Slide->slide_id;
        $detailId = $Slide->detail_id;
        AlbumsModel::where('id', $slideId)->delete();
        AlbumsModel::where('id', $detailId)->delete();
        $Slide->delete();
        return true;
    }
}
