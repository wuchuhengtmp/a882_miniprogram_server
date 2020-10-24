<?php

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Controller;
use App\Models\AlbumsModel;
use App\Models\UsersModel;
use App\Models\UserRolesModel;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\UsersCreateRequest as CreateRequest;
use App\Models\UserBannersModel;
use Illuminate\Support\Facades\DB;
use App\Models\RolesModel;

class UsersController extends Controller
{
    private $_UsersModel;

    private $_UserBannerModel;

    private $_UserRoleModel;

    private $_RolesModel;

    public function __construct(
        UsersModel $usersModel,
        UserBannersModel $userBannersModel,
        UserRolesModel $userRolesModel,
        RolesModel $rolesModel
    )
    {
        $this->_UsersModel = $usersModel;
        $this->_UserBannerModel = $userBannersModel;
        $this->_UserRoleModel = $userRolesModel;
        $this->_RolesModel = $rolesModel;
    }

    public function show()
    {
        $str = '{
            "name": "Serati Ma",
            "avatar": "https://gw.alipayobjects.com/zos/antfincdn/XAosXuNZyF/BiazfanxmamNRoxxVxka.png",
            "userid": "00000001",
            "email": "antdesign@alipay.com",
            "signature": "海纳百川，有容乃大",
            "title": "交互专家",
            "group": "蚂蚁集团－某某某事业群－某某平台部－某某技术部－UED",
            "tags": [
                {
                    "key": "0",
                    "label": "很有想法的"
                },
                {
                    "key": "1",
                    "label": "专注设计"
                },
                {
                    "key": "2",
                    "label": "辣~"
                },
                {
                    "key": "3",
                    "label": "大长腿"
                },
                {
                    "key": "4",
                    "label": "川妹子"
                },
                {
                    "key": "5",
                    "label": "海纳百川"
                }
            ],
            "notifyCount": 12,
            "unreadCount": 11,
            "country": "China",
            "geographic": {
                "province": {
                    "label": "浙江省",
                    "key": "330000"
                },
                "city": {
                    "label": "杭州市",
                    "key": "330100"
                }
            },
            "address": "西湖区工专路 77 号",
            "phone": "0752-268888888"
        }';

        $str = json_decode($str, true);
        $user = Auth::user();
        $roles = $user->roles()->pluck('name')->toArray();
        $str['name'] = $user->username;
        $str['userid'] = $user->id;
        $str['roles'] = $roles;
        return $this->successResponse($str);
    }

    public function create(CreateRequest $request)
    {
        $UserModel = $this->_UsersModel;
        $UserModel->username = $request->input('username');
        $UserModel->password = $request->input('password');
        $UserModel->nickname = $request->input('nickname');
        $UserModel->phone = $request->input('phone');
        $UserModel->address = $request->input('address');
        $UserModel->tags = $request->input('tags');
        $UserModel->rate = $request->input('rate');
        $UserModel->start_time = $request->input('start_time');
        $UserModel->end_time = $request->input('end_time');
        $UserModel->latitude = $request->input('latitude');
        $UserModel->longitude = $request->input('longitude');
        try {
            DB::beginTransaction();
            if ($UserModel->save()) {
                //  保存门店图片
                foreach ($request->input('bannerIds') as $id ) {
                    $UserBannerModel = new $this->_UserBannerModel;
                    $UserBannerModel->user_id = $UserModel->id;
                    $UserBannerModel->album_id = $id;
                    $UserBannerModel->save();
                }
                // 图片恢复
                AlbumsModel::withTrashed()
                    ->whereIn('id', $request->input('bannerIds'))
                    ->restore();

                // 添加角色权限
                $UserRoleModel = $this->_UserRoleModel;
                $id = $this->_RolesModel->where('name', 'shop')
                    ->select('id')
                    ->first();
                $roleId = $id->id;
                $UserRoleModel->user_id = $UserModel->id;
                $UserRoleModel->role_id = $roleId;
                $UserRoleModel->save();
                DB::commit();
            } else {
                throw new \Exception('保存失败');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            throw new InnerErrorException('添加用户失败');
        }
        return $this->successResponse([
            'id' => $UserBannerModel->id
        ]);
    }
}

