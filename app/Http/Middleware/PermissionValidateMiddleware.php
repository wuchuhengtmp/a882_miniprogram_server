<?php
/**
 *  权限验证中间件
 */

namespace App\Http\Middleware;

use App\Exceptions\InnerErrorException;
use App\Models\PermissionsModel;
use App\Models\RolePermissionsModels;
use App\Models\UsersModel;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Services\AuthService;

class PermissionValidateMiddleware
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
        $method = Route::current()->getActionMethod();
        $controller = str_replace('\\', '_', get_class(Route::current()->controller));

        $isAdmin = $this->_AuthService->hasRole('admin');
        $isShop = $this->_AuthService->hasRole('shop');
        if ($isAdmin){
            return $next($request);
        } else if ($isShop) {
            $roles = Auth::user()->roles;
            foreach ($roles as $role) {
                $roleId = $role->id;
                DB::enableQueryLog(); // Enable query log

                $permission = PermissionsModel::where('controller', $controller)
                    ->where('method', $method)
                    ->select('id')
                    ->first();
                $permissionId = $permission->id;
                $hasPermission = RolePermissionsModels::where('role_id', $roleId)
                    ->where('permission_id', $permissionId)
                    ->first();
                if ($hasPermission) return $next($request);
            }
            throw new InnerErrorException('无权限访问', 40002, 4);
        }
        throw new InnerErrorException('无权限访问', 40002, 4);
    }
}
