<?php


namespace App\Http\Services;


use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function hasRole(string $role): bool
    {
        $hasRole = Auth::user()->roles()->where('name', $role)->first();
        return $hasRole ? true : false;
    }

    public function getPermissionByRoleId($id)
    {

    }
}
