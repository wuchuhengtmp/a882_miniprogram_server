<?php

namespace App\Http\Requests\WechatApi;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticationsCreateRequest extends FormRequest
{
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
            'code.required' => '参数code不存在'
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
            'code' => [
                'required'
            ],
            'avatarUrl' => 'required',
            'city' => 'required',
            'country' => 'required',
            'gender' => 'required',
            'language' => 'required',
            'nickName' => 'required',
            'province' => 'required',
        ];
    }
}
