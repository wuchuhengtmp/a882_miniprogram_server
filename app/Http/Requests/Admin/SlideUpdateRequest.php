<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\SlidesModel;
use App\Exceptions\InnerErrorException;

class SlideUpdateRequest extends FormRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $id = request()->route('id');
        if (!SlidesModel::where('id', $id)->first()) throw new InnerErrorException('幻灯片不存在', 40002, 4);
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'detail_id' => [
                'required',
                'exists:albums,id'
            ],
            'slide_id' => [
                'required',
                'exists:albums,id'
            ]
        ];
    }
}
