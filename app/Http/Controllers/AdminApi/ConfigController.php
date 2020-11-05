<?php

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ConfigShowRequest;
use App\Http\Requests\Admin\ConfigUpdateRequest;
use Illuminate\Http\Request;
use App\Models\ConfigsModel;
use App\Models\AlbumsModel;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    private $_ConfigModel;

    public function __construct(
        ConfigsModel $_ConfigModel
    )
    {
        $this->_ConfigModel = $_ConfigModel;
    }

    public function index()
    {
        $ConfigModel = $this->_ConfigModel;
        $configs = $ConfigModel->select('id', 'name', 'value')->get();
        return $this->successResponse($configs->toArray());
    }

    public function show($key, ConfigShowRequest $request)
    {
        $value = getConfigByKey($key);
        // 图片配置
        if (in_array($key, ['BACK_LOGO'])) {
            $Album = AlbumsModel::where('id', $value)->first();
            return $this->successResponse([
                'id' => $Album->id,
                'url' => $Album->url
            ]);
        }
        return $this->successResponse(['value' => $value]);
    }

    /**
     * 修改
     * @param $key
     * @param ConfigUpdateRequest $request
     * @return int
     */
    public function update($key, ConfigUpdateRequest $request, ConfigsModel $configsModel)
    {
        $value = $request->input('value');
        DB::beginTransaction();
        try {
            if (in_array($key, ['BACK_LOGO'])) {
                $oldValue = getConfigByKey($key);
                AlbumsModel::where('id', $oldValue)->delete();
                AlbumsModel::withTrashed()->where('id', $value)->restore();
            }
            $Config = $configsModel->where('name', $key)->first();
            $Config->value = $value;
            $Config->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new InnerErrorException($e->getMessage());
        }
        return $this->successResponse();
    }
}
