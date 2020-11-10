<?php

namespace App\Http\Requests\Admin;

use App\Exceptions\InnerErrorException;
use App\Models\AlbumsModel;
use App\Models\PayNoticesModel;
use Illuminate\Foundation\Http\FormRequest;

class PayNoticesEditRequest extends FormRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $id = request()->route('id');
        $haItem = PayNoticesModel::where('id', $id)->first();
        if (!$haItem)  throw new InnerErrorException('没有这个支付须知', 40002, 4);
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
            'title' => ['required'],
            'content' => ['required'],
            'icon' => [
                'required',
                function($attr, $value, $fail) {
                    $id = request()->route('id');
                    // 图片是不是这个支付须知的?
                    $Item = PayNoticesModel::where('id', $id)->first();
                    if ($Item->icon_id != $value) {
                        $Album = AlbumsModel::withTrashed()->where('id', $value)->first();
                        if (!$Album) throw new InnerErrorException('没有这个图', 40002, 4);
                        if (!$Album->deleted_at) throw new InnerErrorException( '无效图片', 4002, 4);
                    }
                }
            ]
        ];
    }
}
