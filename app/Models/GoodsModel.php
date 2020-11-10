<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Symfony\Component\String\u;

class GoodsModel extends BaseModel
{
    use SoftDeletes;

    protected $table = 'goods';

    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'category_id',
        'brand_id',
        'user_id',
        'cost',
        'tag_ids',
        'total',
        'status',
        'thumb_id',
        'insurance_cost',
        'base_cost',
        'service_cost'
    ];

    public function setTagIdsAttribute($value)
    {
        $tagIds = $this->arrToJson($value);
        $this->attributes['tag_ids'] = $tagIds;
    }

    public function getTagIdsAttribute($value)
    {
        return $this->jsonToArr($value);
    }

    public function getTagsAttribute()
    {
        $tagIds = $this->attributes['tag_ids'];
        $tagIds = $this->jsonToArr($tagIds);
        $tagNames = GoodsTagsModel::whereIn('id', $tagIds)
            ->select('id', 'name')
            ->get()
            ->toArray();
        return $tagNames;
    }

    public function getCategoryAttribute()
    {
        $categoryId = $this->attributes['category_id'];
        $category = CategoresModel::where('id', $categoryId)
            ->select('id', 'name')
            ->first();
        return $category;
    }

    public function getUserAttribute()
    {
        $userId = $this->attributes['user_id'];
        $user = UsersModel::where('id', $userId)
            ->select('id', 'nickname')
            ->first();
        return $user;
    }

    public function getBrandAttribute()
    {
        $brandId = $this->attributes['brand_id'];
        $Brand = BrandsModel::where('id', $brandId)
            ->select('id', 'name')
            ->first();
        return $Brand;
    }

    public function getBannerAttribute()
    {
        $bannerId = $this->attributes['banner_id'];
        $Album = AlbumsModel::where('id', $bannerId)
            ->first()
            ->append('url');
        return collect([
            'id' => $Album->id,
            'url' => $Album->url
        ]);
    }

    public function getStatusAttribute($value)
    {
        return (bool) $value;
    }

}
