<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'password.digits_between' => '密码长度介于6-20位'
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
            'nickname' => [ 'required' ],
            'rate' => [ 'required' ],
            'phone' => [ 'required' ],
            'address' => [ 'required' ],
            'latitude' => [ 'required' ],
            'longitude' => [ 'required' ],
            'start_time' => [ 'required' ],
            'end_time' => [ 'required' ],
            'banners' => [ 'required' ],
            'password' => [
                function($attr, $value, $fail) {
                    $length = 8;
                    if (strlen($value) < $length ) return $fail("密码长度不能小于{$length}位");
                }
            ]
        ];
    }
}
