<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\AlbumsModel;

class PayNoticesCreateRequest extends FormRequest
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
            'title' => [ 'required' ],
            'icon' => [
                'required',
                function($attr, $value, $fail) {
                    $Album = AlbumsModel::withTrashed()->where('id', $value)->first();
                    if (!$Album) {
                        return $fail('icon图标不存在');
                    } else if (!$Album->deleted_at) {
                        return $fail('无效图片');
                    }
                }
            ],
            'content' => [
                'required'
            ]
        ];
    }
}
