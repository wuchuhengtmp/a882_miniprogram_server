<?php
/**
 *  对外公开的信息
 */
namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use App\Models\AlbumsModel;
use App\Models\ConfigsModel;
use Illuminate\Http\Request;

class BasesController extends Controller
{
    public function index(ConfigsModel $configsModel, AlbumsModel $albumsModel)
    {
        $Config = $configsModel->where('name', 'BACK_LOGO')->first();
        $Album = $albumsModel->where('id', $Config->value)->first();
        return $this->successResponse([
            'back_logo' => $Album->url
        ]);
    }
}
