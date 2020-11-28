<?php

namespace App\Http\Controllers;

use App\Events\CreateMemberEvent;
use App\Listeners\CreateMemberListener;
use Illuminate\Http\Request;
use App\Models\AlbumsModel;
use Illuminate\Support\Facades\Storage;
use App\Models\PermissionsModel;

class TestController extends Controller
{
    public function index(Request $request)
    {
        CreateMemberEvent::dispatch(1);
    }
}
