<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\AlbumsModel;

class SlideCreateRequest extends FormRequest
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
            'slide_id' => [
                'required',
                function($att, $value, $fail) {
                    $Album = AlbumsModel::withTrashed()->where('id', $value)->first();
                    if (!$Album)  return $fail('没有这个图片');
                }
            ],
            'detail_id' => [
                'required',
                function($att, $value, $fail) {
                    $Album = AlbumsModel::withTrashed()->where('id', $value)->first();
                    if (!$Album)  return $fail('没有这个图片');
                }
            ]
        ];
    }
}
