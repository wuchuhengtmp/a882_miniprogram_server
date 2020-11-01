<?php

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\AlbumsModel;
use App\Models\UsersModel;
use App\Models\UserRolesModel;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\UsersCreateRequest as CreateRequest;
use App\Models\UserBannersModel;
use Illuminate\Support\Facades\DB;
use App\Models\RolesModel;
use App\Models\RegionsModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\Admin\UsersUpdateIsDisableRequest;
use Lcobucci\JWT\Signer\Hmac;

class UsersController extends Controller
{
    private $_UsersModel;

    private $_UserBannerModel;

    private $_UserRoleModel;

    private $_RolesModel;

    private $_RegionModel;

    private $_Request;

    public function __construct(
        Request $request,
        UsersModel $usersModel,
        UserBannersModel $userBannersModel,
        UserRolesModel $userRolesModel,
        RolesModel $rolesModel,
        RegionsModel $_RegionModel
    )
    {
        $this->_Request = $request;
        $this->_UsersModel = $usersModel;
        $this->_UserBannerModel = $userBannersModel;
        $this->_UserRoleModel = $userRolesModel;
        $this->_RolesModel = $rolesModel;
        $this->_RegionModel = $_RegionModel;
    }

    public function index()
    {
        $result = request()->input('result', 10);
        $roleId = $this->_RolesModel->getIdByName('shop');
        $users = (new UsersModel())
            ->join('user_roles', function($join) use($roleId) {
                $join->on('user_roles.user_id', '=', 'users.id')
                    ->where('user_roles.role_id', $roleId);
            })
            ->select(
        'users.id',
                'users.username',
                'users.nickname',
                'users.phone',
                'users.tags',
                'users.address',
                'users.rate',
                'users.start_time',
                'users.end_time',
                'users.latitude',
                'users.longitude',
                'users.is_disable',
                'users.created_at'
            )
            ->paginate($result);
        $items = $users->items();
        foreach ($items as $key => &$item) {
            $banners = $this->_UserBannerModel->where('user_id', $item->id)
                ->get();
            $bannerUrls = [];
            foreach ($banners as $banner) {
                try{
                    $bannerUrls[] =[
                        'id' => $banner->album->id,
                        'url' => $banner->album->url
                    ];
                } catch (\Exception $e) {
                    dd($banner->toArray());
                }
            }
            $item->start_time = substr($item->start_time, 0, strlen($item->start_time) - 3);
            $item->end_time = substr($item->end_time, 0, strlen($item->end_time) - 3);
            $item->banners = $bannerUrls;
            $created_at = $item->created_at->format('Y-m-d H:i');
            $item = $item->toArray();
            $items[$key]['created_at'] = $created_at;
        }

        $returnData = [
            'items' => $items,
            'count' => $users->total()
        ];

        return $this->successResponse($returnData);
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
        $UserModel->password = Hash::make($request->input('password'));
        $UserModel->nickname = $request->input('nickname');
        $UserModel->phone = $request->input('phone');
        $UserModel->address = $request->input('address');
        $UserModel->tags = $request->input('tags', []);
        $UserModel->rate = $request->input('rate');
        $UserModel->start_time = $request->input('startTime');
        $UserModel->end_time = $request->input('endTime');
        $UserModel->latitude = $request->input('latitude');
        $UserModel->longitude = $request->input('longitude');
        $amapKey = getConfigByKey('AMAP_KEY');
        $location = $UserModel->longitude . ',' . $UserModel->latitude;
        $mapInfo = json_decode(file_get_contents("https://restapi.amap.com/v3/geocode/regeo?key={$amapKey}&location={$location}"), true);
        if ($mapInfo['info'] === 'OK') {
            $adcode = $mapInfo['regeocode']['addressComponent']['adcode'];
            $RegionsModel = $this->_RegionModel;
            if (!$RegionsModel->where('id', $adcode)->first()) throw new InnerErrorException('该地区编码未收录');
            $UserModel->region_id = $adcode;
        } else {
           throw new InnerErrorException('该地址查不到地区编');
        }
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

    /**
     *  修改禁用状态
     */
    public function updateIsDisable(UsersUpdateIsDisableRequest $request)
    {
        $isDisable = $request->input('isDisable');
        $id = $request->route('id');
        $UserModel = $this->_UsersModel;
        $User = $UserModel->where('id', $id)->first();
        $User->is_disable = $isDisable ? 1 : 0;
        if ($User->save()) return $this->successResponse();
        throw new InnerErrorException();
    }

    /**
     * 编辑
     */
    public function update(UserUpdateRequest $request)
    {
        $userId = $request->route('id');
        $User = $this->_UsersModel->where('id', $userId)->first();
        $User->nickname = $request->nickname;
        if ($request->has('password')) $User->password= Hash::make($request->input('password'));
        $User->phone = $request->input('phone');
        $User->tags= explode(',', $request->input('tags'));
        $User->address = $request->input('address');
        $User->latitude = $request->input('latitude');
        $User->longitude = $request->input('longitude');
        $User->start_time = $request->input('start_time');
        $User->rate = $request->input('rate');
        $User->end_time = $request->input('end_time');
        $userBannerIds = array_map(
            function (int $item) {
               return $item;
            },
            explode(',',  $request->input('banners'))
           );

        $albumIds = $this->_UserBannerModel->where('user_id', $userId)
            ->select('album_id')
            ->get()
            ->pluck('album_id')
            ->toArray();
        DB::beginTransaction();
        try{
            // 删除多余的banner图
            $willDeleteIds = array_filter($albumIds, function($item) use ($userBannerIds) {
                return !in_array($item, $userBannerIds);
            });
            if ($willDeleteIds) {
                $WillDeleteBanners = $this->_UserBannerModel->whereIn('album_id', $willDeleteIds)->get();
                foreach ($WillDeleteBanners as $UserBanner) {
                    $UserBanner->album->delete();
                    $UserBanner->delete();
                }
            }
            // 添加新增加banner图
            $newAlbumIds = array_filter($userBannerIds, function ($item ) use ($albumIds) {
                return !in_array($item, $albumIds);
            });
            foreach ($newAlbumIds as $newAlbumId) {
                $UserBanner = new UserBannersModel();
                $UserBanner->user_id = $userId;
                $UserBanner->album_id = $newAlbumId;
                $UserBanner->save();
                AlbumsModel::withTrashed()
                    ->where('id', $newAlbumId)
                    ->restore();
            }
            $User->save();
            DB::commit();
            return $this->successResponse();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new InnerErrorException();
        }
    }

    /**
     * 展博所有店铺名称
     */
     public function showShopName()
     {
         $roleId = $this->_RolesModel->getIdByName('shop');
         $users = $this->_UsersModel
             ->join('user_roles', function($join) use($roleId) {
                 $join->on('user_roles.user_id', '=', 'users.id')
                     ->where('user_roles.role_id', $roleId);
             })
             ->select('users.id', 'users.nickname')
             ->get();
         return $this->successResponse($users->toArray());
     }
}

