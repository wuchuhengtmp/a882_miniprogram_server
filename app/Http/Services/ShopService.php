<?php

/**
 * 为门店提供服务
 */

namespace App\Http\Services;

use App\Models\RolesModel;
use App\Models\UsersModel;
use phpDocumentor\Reflection\Types\Boolean;

class ShopService
{
    /**
     *  获取区域的店铺供用户选择
     * @param number $id
     * @return Array
     */
    public function getShopSByAreaId(int $id): Array
    {
        $return_data = [];
        $Shops = UsersModel::where('region_id', $id)->get();
        if ($Shops->isEmpty()) return $return_data;

        foreach ($Shops as $Shop) {
            $regionName = $Shop->region->name;
            list(, $address) = explode($regionName, $Shop->address);
            $item = [
                'id' => $Shop->id,
                'nickname' => $Shop->nickname,
                'address' => $address,
                'rate' => $Shop->rate,
                'tags' => $Shop->tags,
                'latitude' => $Shop->latitude,
                'longitude' => $Shop->longitude
            ];
            $return_data[] = $item;
        }
        return $return_data;
    }


    /**
     *  在门店是否存在
     * @param int $id
     * @return bool
     */
    public function hasShopByid(int $id): bool
    {
        $roleId = (new RolesModel())->getIdByName('shop');

        $user = UsersModel::where('users.id', $id)
            ->join('user_roles', function($join) use($roleId) {
                $join->on('users.id', '=', 'user_id')
                    ->where('role_id', $roleId);
            })
            ->select('users.id')
            ->first();
        return $user ? true : false;
    }
}
