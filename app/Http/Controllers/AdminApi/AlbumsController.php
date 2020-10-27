<?php

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlbumCreateRequest;
use App\Models\AlbumsModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;

class AlbumsController extends Controller
{
    protected $_AlbumsModel;

    protected $_request;

    public function __construct(
        AlbumsModel $albumsModel,
        Request $request
    )
    {
        $this->_request = $request;
        $this->_AlbumsModel = $albumsModel;
    }

    /**
     *  上传图片
     */
    public function create(AlbumCreateRequest $request)
    {
        $disk = 'public';
        $path =  str_replace($disk  . '/', '', $request->file('img')->store($disk));
        $Album = $this->_AlbumsModel;
        $Album->path = $path;
        $Album->disk = $disk;
        if ($Album->save()) {
            $id = $Album->id;
            $Album->delete();
            return $this->successResponse([
                'id' => $id,
                'url' => Storage::disk($disk)->url($path)
            ]);
        }
        throw new InnerErrorException();
    }


    /**
     *  删除用户相册
     * @param number $id
     */
    public function shopBannerDestroy()
    {
        $request = $this->_request;
        $request->route('id');
        dd(1);
    }
}
