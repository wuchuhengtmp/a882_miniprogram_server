<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UsersCreateRequest extends FormRequest
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
            'username.required' => '请输入账号',
            'username.unique' => '账号已存在',

            'password.required' => '请输入密码',
            'nickname.required' => '请输入店名',
            'phone.required' => '请输入手机',
            'phone.regex' => '手机不正确',
            'rate.required' => '请输入评分',
            'startTime.required' => '请输入营业开始时间',
            'endTime.required' => '请输入营业结束时间',
            'address.required' => '请输入地址',
            'latitude.required' => '请输入纬度',
            'longitude.required' => '请输入经度',
            'bannerIds.required' => '请输入店铺图片',
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
            'username' => [
                'required',
                'unique:users,username'
            ],
            'password' => [ 'required' ],
            'nickname'  => [ 'required' ],
            'phone' => [
                'required',
                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/'
            ],
            'rate' => [ 'required' ],
            'startTime' => [ 'required' ],
            'endTime' => [ 'required' ],
            'address' => [ 'required' ],
            'latitude' => [ 'required' ],
            'longitude' => [ 'required' ],
            'bannerIds' => [ 'required' ]
        ];
    }
}
