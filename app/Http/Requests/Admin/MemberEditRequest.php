<?php

namespace App\Http\Requests\Admin;

use App\Exceptions\InnerErrorException;
use App\Models\MemberRolesModel;
use App\Models\MembersModel;
use Illuminate\Foundation\Http\FormRequest;

class MemberEditRequest extends FormRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $memberId = request()->route('id');
        $hasMember = MembersModel::where('id', $memberId)->first();
        if (!$hasMember) throw new InnerErrorException('没有这个用户', 40002, 4);
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
            'phone.regex' => '手机号不正确'
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
            'memberRoleId' => [
                'required',
                function($attr, $value, $fail) {
                    $hasMemberRole = MemberRolesModel::where('id', $value)->first();
                    if (!$hasMemberRole) throw new InnerErrorException('没有这个角色', 4002, 4);
                }
            ],
            'phone' => [
                'required',
                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/'
            ]
        ];
    }
}
