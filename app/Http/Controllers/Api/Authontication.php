<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticationsCreateTokenRequest;
use App\Models\UsersModel;

class Authontication extends Controller
{
    /**
     * 登录
     * @param AuthenticationsCreateTokenRequest $request
     * @return int
     */
    public function create(AuthenticationsCreateTokenRequest $request)
    {
        $validated = $request->validated();
        $user = UsersModel::where('username', $validated['username'])->first();
        $token = auth('api')->login($user);
        return $this->successResponse(['token' => $token]);
    }
}
