<?php

namespace App\Http\Requests\WechatApi;

use App\Exceptions\InnerErrorException;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\RegionsModel;

class ShopIndexShopsRequest extends FormRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $cityName = request()->route('cityName');
        $hasItem = RegionsModel::where('name', 'like', "{$cityName}%" )
            ->select('id')
            ->first();
        if (!$hasItem) throw new InnerErrorException('没有这个城市', 40002, 4);
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
