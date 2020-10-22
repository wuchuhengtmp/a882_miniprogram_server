<?php

namespace App\Http\Requests\Admin;

use App\Models\GoodsTagsModel;
use Illuminate\Foundation\Http\FormRequest;

class ManagementGoodsTagsEditRequest extends FormRequest
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
                    !$id && $fail('id不存在');
                    if (GoodsTagsModel::where('id', $id)->get()->isEmpty()) {
                        $fail('id不存在');
                    }
                }
            ]
        ];
    }
}
