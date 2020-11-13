<?php

namespace App\Http\Requests\Admin;

use App\Exceptions\InnerErrorException;
use Faker\DefaultGenerator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\AlbumsModel;

class CouponsCreateRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cost' => [
                'required',
                'numeric',
                function ($attr, $value, $fail) {
                    if ($value < 0.01 )  return $fail('金额不能小于0.01');
                }
            ],
            'des' => ['required'],
            'expiredDay' => [
                'required',
                'numeric',
                function ($attr, $value, $fail) {
                    if ($value <= 0 ) $fail('有效期不能小于0天');
                }
            ],
            'giveType' => [
                'required',
                function ($attr, $value, $fail) {
                    switch ($value) {
                        case 1: break;
                        case 2: break;
                        default:
                            return $fail('派送方式不正确');
                    }
                }
            ],
            'isUse' => [
                'required',
                'boolean'
            ],
            'name' => [
                'required',
            ],
            'banner' => [
                'required',
                function ($attr, $value, $fail) {
                    $isExists = AlbumsModel::withTrashed()
                        ->where('id', $value)->first();
                    if(!$isExists) throw new InnerErrorException('没有这个图片', 40002, 4);
                    if (!$isExists->deleted_at) throw new InnerErrorException('图片失效', 40002, 4);
                }
            ],
            'isAlert' => [
                'required',
                'boolean'
            ]
        ];
    }
}
