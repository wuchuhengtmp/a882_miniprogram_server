<?php

namespace App\Http\Requests\Admin;

use App\Exceptions\InnerErrorException;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\PayNoticesModel;

class PayNoticesDestroyRequest extends FormRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $id = request()->route('id');
        $HasItem = PayNoticesModel::where('id', $id)->first();
        if (!$HasItem)  throw new InnerErrorException('没有这个支付须知', 40002, 4);
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
