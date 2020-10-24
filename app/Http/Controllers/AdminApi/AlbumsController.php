<?php

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlbumCreateRequest;
use App\Models\AlbumsModel;
use Illuminate\Support\Facades\Storage;

class AlbumsController extends Controller
{
    protected $_AlbumsModel;

    public function __construct(AlbumsModel $albumsModel)
    {
        $this->_AlbumsModel = $albumsModel;
    }

    /**
     *  上传图片
     */
    public function create(AlbumCreateRequest $request)
    {
        $disk = 'public';
        $path = $request->file('img')->store($disk);
        $Album = $this->_AlbumsModel;
        $Album->path = $path;
        $Album->disk = $disk;
        if ($Album->save()) {
            $id = $Album->id;
            $Album->delete();
            return $this->successResponse([
                'id' => $id,
                'url' => Storage::disk($disk)->url('m5uzShUD6dQ56mCZMOsbH9xiQ4EusQY4EHCKXn6y.jpeg')
            ]);
        }
        throw new InnerErrorException();
    }
}
