<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolesModel extends Model
{
    protected $table = 'roles';

    /**
     *  获取角色id
     * @param string $roleName
     * @return int|null
     */
    public function getIdByName(string $roleName): ?int
    {
        $roles = $this->where('name', $roleName)
            ->select('id')
            ->limit(1)
            ->get();
        if ($roles->isNotEmpty() ) {
            (int) $id = $roles->first()->id;
            return $id;
        } else {
            return null;
        }
    }

    /**
     * 获取权限
     */
    public function permissions()
    {
        return $this->hasManyThrough(
            RolesModel::class,
            RolePermissionsModels::class,
            'role_id', // 用户表外键->存在中间表中
            'id', // 目标表键名
            'id', //  本地表键名
            'permission_id' // 中间表关联目标表的键名
        );
    }
}
