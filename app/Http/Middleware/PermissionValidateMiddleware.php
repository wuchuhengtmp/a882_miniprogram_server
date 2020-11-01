<?php
/**
 *  权限验证中间件
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class PermissionValidateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dump((Route::current()->getActionMethod()));
//        dd( get_class(Route::current()->controller));
        return $next($request);
    }
}
