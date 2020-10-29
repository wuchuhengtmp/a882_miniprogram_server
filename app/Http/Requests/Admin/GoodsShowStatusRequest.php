<?php

namespace App\Http\Requests\Admin;

use App\Exceptions\InnerErrorException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GoodsShowStatusRequest extends FormRequest
{
   public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
   {
       parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
       $isAdmin = Auth::user()->roles()->where('name', 'admin')->first();
       $isShop = Auth::user()->roles()->where('name', 'shop')->first();
       if (!$isAdmin && !$isShop ) throw new InnerErrorException('您无权操作');
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
