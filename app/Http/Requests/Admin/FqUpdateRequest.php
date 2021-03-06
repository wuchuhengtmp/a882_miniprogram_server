<?php

namespace App\Http\Requests\Admin;

use App\Exceptions\InnerErrorException;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\FqModel;
use Prophecy\Exception\Doubler\InterfaceNotFoundException;

class FqUpdateRequest extends FormRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $id = request()->route('id');
        $Fq = FqModel::where('id', $id)->first();
        if (!$Fq) throw new InnerErrorException('没有这个常见问题: id' . $id, 40002, 4);
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
             'title' => [
                 'required'
             ],
            'content' => [
                'required'
            ],
            'order_no' => [
                'required'
            ]
        ];
    }
}
