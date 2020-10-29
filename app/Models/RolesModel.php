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
}
