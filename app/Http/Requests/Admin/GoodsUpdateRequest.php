<?php

namespace App\Http\Requests\Admin;

use App\Exceptions\InnerErrorException;
use App\Http\Services\AuthService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\u;
use App\Models\GoodsTagsModel;
use App\Models\GoodsModel;

class GoodsUpdateRequest extends FormRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $goodId = request()->route('id');
        if (!GoodsModel::where('id', $goodId)->first()) {
            throw new InnerErrorException('没有这个商品');
        }
        //  鉴权，管理员或门店才能修改
        $isAdmin = Auth::user()->roles()
            ->where('name', 'admin')
            ->first();
        $isGoodsOwn = GoodsModel::where('id', $goodId)
            ->where('user_id', Auth::user()->id)
            ->first();
        if ( !$isAdmin && !$isGoodsOwn ) {
            throw new InnerErrorException('您无权修改这个商品');
        }
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
            'banner_id' => [
                'required',
                'exists:albums,id'
            ],
            'base_cost' => [
                'required',
                function($att, $value, $fail) {
                    if (!is_numeric($value)) return $fail('基本服务保障费用只能是数字');
                    if ($value < 0) $fail('基本保障费用不能小于0');
                }
            ],
            'brand_id'  => [
                'required',
                'exists:brands,id'
            ],
            'category_id' => [
                'required',
                'exists:categores,id'
            ],
            'cost' => [
                'required',
                'numeric',
                function($att, $value, $fail) {
                    if ($value < 0) return $fail('租金不能小于0');
                }
            ],
            'insurance_cost' => [
                'required',
                'numeric',
                function($att, $value, $fail) {
                    if ($value < 0) return $fail('保险不能小于0');
                }
            ],
            'name' => [ 'required' ],
            'pledge_cost' => [
                'required',
                function($att, $value, $fail) {
                    if ($value < 0) return $fail('押金不能小于0');
                }
            ],
            'service_cost' => [
                'required',
                'numeric',
                function($att, $value, $fail) {
                    if ($value < 0) return $fail('手续费不能小于0');
                }
            ],
            'total' => [
                'required',
                'numeric',
                function($att, $value, $fail) {
                    if ($value < 1) return $fail('库存不能小于1');
                }
            ],
            'tag_ids' => [
                'required',
                function($att, $value, $fail) {
                    $tagIds = explode(',', $value);
                    foreach ($tagIds as $tagId) {
                        if (!GoodsTagsModel::where('id', $tagId)->first()) return $fail("标签id: {$tagId}不存在");
                    }
                }
            ]
        ];
    }
}
