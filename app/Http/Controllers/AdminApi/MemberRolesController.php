<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MemberRolesModel;

class MemberRolesController extends Controller
{
    public function index()
    {
        $MemberRoles = MemberRolesModel::get();
        return $this->successResponse($MemberRoles->toArray());
    }
}
