<?php

use App\Models\ConfigsModel;

/**
 *  获取配置
 *
 * @param string $key
 * @return string|null
 */
function getConfigByKey( string $key): ?string
{
    $hasData = ConfigsModel::where('name', $key)
        ->select('value')
        ->first();
    return $hasData ? $hasData->value : false;
}
