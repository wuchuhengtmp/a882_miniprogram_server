<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\UsersModel;
use Illuminate\Support\Facades\Hash;

class AuthenticationsCreateTokenRequest extends FormRequest
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
           'username.required'  => '请输入用户名',
            'username.exists'  => '账号或者密码错误',
           'password.required'  => '请输入密码'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $username = $this->username;
        $password = $this->password;
        return [
            'username' => [
               'required',
                'exists:users,username',
            ],
            'password' => [
                'required',
                function($attribute, $value, $fail) use ($username, $password) {
                    $errorMsg = '账号或者密码错误';
                    if ($username && $password) {
                        $user = UsersModel::where('username', $username)->first();
                        if (!$user) {
                            $fail($errorMsg);
                        } else if(!Hash::check($password, $user->password)) {
                            $fail($errorMsg);
                        }
                    } else {
                        $fail($errorMsg);
                    }
                }
            ]
        ];
    }
}
