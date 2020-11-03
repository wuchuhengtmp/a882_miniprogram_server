<?php

namespace App\Http\Controllers\AdminApi;

use App\Exceptions\InnerErrorException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClausesModel;
use App\Http\Requests\Admin\ClausesUpdateRequest;

class ClausesController extends Controller
{
    public function index(Request $request)
    {
        $result = $request->input('result', 10);
        $Page = ClausesModel::paginate($result);
        $Items = $Page->items();
        foreach ($Items as &$Item) {
            $Item = $Item->toArray();
        }
        return $this->successResponse([
            'items' => $Items,
            'total' => $Page->total()
        ]);
    }

    public function update($id, ClausesUpdateRequest $request)
    {
       $Clause =  ClausesModel::where('id', $id)->first();
       $Clause->content = $request->input('content');
       if ($Clause->save()) {
           return $this->successResponse();
       }
       throw new InnerErrorException();
    }
}
