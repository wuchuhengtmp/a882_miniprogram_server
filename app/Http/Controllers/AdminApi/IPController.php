<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IPController extends Controller
{
    private $_request;

    public function __construct(Request $request)
    {
        $this->_request = $request;
    }

    public function show()
    {
        $ip = $this->_request->ip();
        return $this->successResponse(['ip' => $ip]);
    }
}
