<?php

namespace App\Http\Requests\Admin;

use App\Exceptions\InnerErrorException;
use App\Http\Services\ShopService;
use App\Models\AlbumsModel;
use App\Models\CouponsModel;
use Illuminate\Foundation\Http\FormRequest;

class CouponsEditRequest extends FormRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $id = request()->route('id');
        $hasItem = CouponsModel::where('id', $id)->first();
        if (!$hasItem) throw new InnerErrorException('没有这个优惠卷', 40002, 4);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cost' => [
                'required',
                'numeric',
                'gt:0'
            ],
            'des' => [
                'required'
            ],
            'expiredDay' => [
                'required',
                'numeric',
                'gt:0'
            ],
            'giveType' => [
                'required',
                'in:1,2'
            ],
            'name' => [
                'required'
            ],
            'banner' => [
                'required',
                'numeric',
                function ($attr, $value, $fail) {
                    $isExists = AlbumsModel::where('id', $value)->first();
                    $id = $this->route('id');
                    $Coupons = CouponsModel::where('id', $id)->first();
                    $isNewImg = $Coupons->album_id != $value;
                    if ($isNewImg) {
                        $isExists = AlbumsModel::withTrashed()
                            ->where('id', $value)->first();
                        if(!$isExists) throw new InnerErrorException('没有这个图片', 40002, 4);
                        if (!$isExists->deleted_at) throw new InnerErrorException('图片失效', 40002, 4);
                    }
                }
            ],
            'isUse' => [
                'required'
            ],
            'isAlert' => [
                'required',
                'boolean'
            ],
        ];
    }
}
