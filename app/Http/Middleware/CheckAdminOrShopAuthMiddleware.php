<?php


/**
 *  管理员或门店管理员权限鉴定
 */

namespace App\Http\Middleware;

use App\Exceptions\InnerErrorException;
use App\Http\Services\AuthService;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminOrShopAuthMiddleware
{
    private $_AuthService;

    public function __construct(AuthService $authService)
    {
        $this->_AuthService = $authService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $isAdmin = $this->_AuthService->hasRole('admin');
        $isShop = $this->_AuthService->hasRole('shop');
        if (!$isAdmin && !$isShop) throw new InnerErrorException('您不是门店管理员或超级管理员，无权访问');
        return $next($request);
    }
}
