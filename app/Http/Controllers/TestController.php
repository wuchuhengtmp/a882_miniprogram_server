<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlbumsModel;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $url = 'public/ldIOV6jNwqUw5gi8ESPnOS18AAa6wP7NdEjyZoBZ.jpeg';
        $url = Storage::disk('public')->path($url);
        dd($url);
//        $res = AlbumsModel::withTrashed()
//            ->whereIn('id', [1, 2])
//            ->restore();
//        dd($res);
//        $url = $request->url();
//        $urlInfo = parse_url($url);
//        $domain = $urlInfo['scheme'] . '://' . $urlInfo['host'] . '/';
//        return $domain;
    }
}
