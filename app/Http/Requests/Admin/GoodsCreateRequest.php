<?php

namespace App\Http\Requests\Admin;

use App\Exceptions\InnerErrorException;
use App\Models\RolesModel;
use App\Models\UsersModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\u;
use App\Models\GoodsTagsModel;
use App\Models\AlbumsModel;

class GoodsCreateRequest extends FormRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $roles = Auth::user()->roles();
        $isShopRole = $roles->where('name', 'shop')->first();
        if (!$isShopRole && !request()->has('shop_ids'))
        {
            throw new InnerErrorException('门店id组不能为空');
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


    public function messages()
    {
        return [
            'name.required' => '商品名不能为空',
            'category_id.required' => '分类不能为空',
            'category_id.exists' => '分类不存在',
            'brand_id.required' => '品牌不能为空',
            'brand_id.exists' => '品牌不存在',
            'cost.required' => '费用不能为空',
            'tag_ids.required' => '标签不能为空',
            'total.required' => '商品的数量不能为空',
            'banner_id.required' => '请上传图片',
            'insurance_cost.required' => '请输入保险费',
            'base_cost.required' => '请输入基本的保障费',
            'service_cost.required' => '请输手续费',
            'pledge_cost.required' => '请输入押金',
            'status.required' => '请输入状态',
            'status.in' => '状态为1或0',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [ 'required' ],
            'category_id' => [
                'required',
                'exists:categores,id'
            ],
            'brand_id' => [
                'required',
                'exists:brands,id'
            ],
            'cost' => [
                'required',
                function($attr, $value, $fail) {
                    if (!is_numeric($value))  $fail('请输入正确的租金');
                    if ($value < 0.01 ) $fail('租金不能小于0.01');
                }
            ],
            'tag_ids' => [
                'required',
                function($attr, $value, $fail) {
                    $ids = explode(',', $value);
                    foreach ($ids as $id) {
                       if (GoodsTagsModel::where('id', $id)->get()->isEmpty()) {
                           $fail("商品标签id:{$id} 不存在");
                       }
                    }
                }
            ],
            'total' => [
                'required',
                function($attr, $value, $fail) {
                    $intValue = (int) $value;
                    if ($value != $intValue) {
                        $fail('商品的数量必需为整数');
                    }
                }
            ],
            'banner_id' => [
                'required',
                function($attr, $value, $fail) {
                    $hasItem = AlbumsModel::withTrashed()
                        ->where('id', $value)
                        ->first();
                    !$hasItem && $fail('图片不存在');
                }
            ],
            'insurance_cost' => [
                'required',
                function($attr, $value, $fail) {
                    !is_numeric($value) && $fail('请输入正确的保险费');
                     $value < 0 && $fail('保险不能小于0');
                }
            ],
            'base_cost' => [
                'required',
                function($attr, $value, $fail) {
                    !is_numeric($value) && $fail('请输入正确的保障费');
                    $value < 0 && $fail('保障费不能小于0');
                }
            ],
            'service_cost' => [
                'required',
                function($attr, $value, $fail) {
                    !is_numeric($value) && $fail('请输入正确的手续费');
                    $value < 0 && $fail('手续费不能小于0');
                }
            ],
            'pledge_cost' => [
                'required',
                function($attr, $value, $fail) {
                    !is_numeric($value) && $fail('请输入正确的押金');
                    $value < 0 && $fail('押金不能小于0.01');
                }
            ],
            'shop_ids' => [
                function($attr, $value, $fail) {
                    $value = trim($value);
                    if ( strlen($value) === 0) return;
                    $roles = Auth::user()->roles();
                    if(!$roles->where('name', 'admin')->first()) $fail('您没有向多个门店添加车辆的权限');
                    $userIds = explode(',', $value);
                    $userIds = array_unique($userIds);
                    foreach ($userIds as $userId) {
                        $shopRoleId = (new RolesModel)->getIdByName('shop');
                        $hasUser = UsersModel::join('user_roles', function($join) use($shopRoleId, $userId) {
                                $join->where('role_id', $shopRoleId )
                                    ->where('user_id', $userId);
                            })
                            ->first();
                        if (!$hasUser) return $fail("用户id:{$userId}, 不是门店用户，不能添加车辆");
                    }
                }
            ],
            'status' => [
                'required',
                'in:0,1'
            ]
        ];
    }
}
