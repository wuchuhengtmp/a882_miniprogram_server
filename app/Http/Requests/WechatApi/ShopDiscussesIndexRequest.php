<?php

namespace App\Http\Requests\WechatApi;

use App\Exceptions\InnerErrorException;
use App\Http\Services\ShopService;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\UsersModel;
use App\Models\RolesModel;

class ShopDiscussesIndexRequest extends FormRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        // 门店是否存在
        $id = (int) request()->route('id');
        if (!(new ShopService())->hasShopByid($id)) {
            throw new InnerErrorException('没有这个商店', 40002, 1);
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
            //
        ];
    }
}
