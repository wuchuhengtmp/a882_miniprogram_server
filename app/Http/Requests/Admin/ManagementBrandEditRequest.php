<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\BrandsModel;

class ManagementBrandEditRequest extends FormRequest
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
            'name' => [
                'required',
                function($attribute, $value, $fail) {
                    $id = $this->route('id');
                    if (!$id) {
                        $fail('品牌id不存在');
                    }
                    $isEmpty = BrandsModel::where('id', $id)->get()->isEmpty();
                    $isEmpty && $fail('品牌id不存在');
                }
            ]
        ];
    }
}
