<?php

namespace App\Http\Controllers\Api\ApiControllers;

use App\Http\Resources\Admin as AdminResource;
use Illuminate\Http\Request;
use App\Admin;

class AdminDetailsController extends Controller
{
    //
    public function getOne(Request $request, $id){
       
        return new AdminResource(Admin::findOrFail($id));        


    }
    public function update(Request $request, $id)
    {
        $admin=  Admin::findOrFail($id);
            $admin->name=$request->name;
            $admin->username=$request->username;
            $admin->password=bcrypt($request->password);

        $admin->save();
        return response()->json([
            'data'=>'Admin Details updated'
        ]);
    }
}