<?php


namespace App\Http\Services;


class CommonService
{

    /**
     *  蛇形键转小驼峰
     * @param $item
     * @param $key
     */
    public function formatCollectionKey(&$item, string $key): void
    {
        $value = $item->$key;
        preg_match_all('/_([a-z])/', $key, $res, PREG_OFFSET_CAPTURE);
        $newKey = $key;
        foreach ($res[0] as $k => $v) {
            $newKey = str_replace($v, strtoupper($res[1][$k][0]), $newKey);
        }
        unset(
            $item->$key
        );
        $item->$newKey = $value;
    }
}
