<?php

namespace App\Http\Requests\Admin;

use App\Exceptions\InnerErrorException;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\ConfigsModel;

class ConfigShowRequest extends FormRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $key = request()->route('key');
        $ItemConfig = ConfigsModel::where('name', $key)->first();
        if (!$ItemConfig) throw new InnerErrorException('没有这个配置', 40002, 4);
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
            //
        ];
    }
}
