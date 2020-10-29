<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     *  数据组转json
     * @param array $params
     * @param int $level
     * @return array|false|string
     */
    protected function arrToJson(array $params, int $level = 0)
    {
        foreach ($params as &$item) {
            if (is_array($item)) {
                $item =  $this->arrToJson($item, 1);
            } else {
                $item = urlencode($item);
            }
        }
        return $level === 0 ? json_encode($params) : $params;
    }

    protected function jsonToArr($json, bool $isDecode = false): array
    {
        $arr = $isDecode ? $json : json_decode($json, true);
        foreach ($arr as &$item) {
            if (is_array($item)) {
               $item = $this->jsonToArr($item, true);
            } else {
                $item = urldecode($item);
            }
        }
        return $arr;
    }
}
