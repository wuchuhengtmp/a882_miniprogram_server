<?php

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MemberEditRequest;
use App\Http\Requests\Admin\MembersDestroyRequest;
use App\Http\Services\CommonService;
use Illuminate\Http\Request;
use App\Models\MembersModel;

class MembersController extends Controller
{
    public function index(Request $request, CommonService $commonService)
    {
        $pageSize = $request->input('pageSize', 10);
        $PageInstance = MembersModel::paginate($pageSize);
        $Items = $PageInstance->items();
        array_map(function (&$Item) use($commonService) {
            $cratedAt = $Item->created_at->format('Y-m-d H:i');
            $commonService->formatCollectionKey($Item, 'member_role');
            $commonService->formatCollectionKey($Item, 'avatar_url');
            $Item
                ->append(
                    'member_role'
                )
                ->makeHidden(
                    'open_id',
                    'updated_at',
                    'member_role_id',
                    'language',
                    'created_at',
                    'session_key',
                    'member_role',
                    'avatar_url'
            );

            $Item->createdAt = $cratedAt;
        }, $Items);
        return $this->successResponse([
            'items' => $Items,
            'total' => $PageInstance->total()
        ]);
    }

    /**
     *  修改
     * @param $id
     */
    public function edit($id, MemberEditRequest $request)
    {
        $Member = MembersModel::where('id', $id)->first();
        $Member->member_role_id  = $request->input('memberRoleId');
        $Member->phone = $request->input('phone');
        if ($Member->save())  return $this->successResponse();
        throw new InnerErrorException('内部错误', 40002, 4);
    }

    public function destroy($id, MembersDestroyRequest $request)
    {

    }
}
