<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PayNoticesModel;
use Illuminate\Http\Request;

class PayNoticesController extends Controller
{
    public function index(PayNoticesModel $payNoticesModel)
    {
        $PayNotices = $payNoticesModel
            ->select( 'id', 'title', 'content', 'icon_id' )->get()
            ->append('icon')
            ->makeHidden('icon_id');
        return $this->successResponse($PayNotices->toArray());
    }
}
