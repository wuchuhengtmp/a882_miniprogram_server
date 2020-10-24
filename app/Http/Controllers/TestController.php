<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlbumsModel;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $res = AlbumsModel::withTrashed()
            ->whereIn('id', [1, 2])
            ->restore();
        dd($res);
        $url = $request->url();
        $urlInfo = parse_url($url);
        $domain = $urlInfo['scheme'] . '://' . $urlInfo['host'] . '/';
        return $domain;
    }
}
