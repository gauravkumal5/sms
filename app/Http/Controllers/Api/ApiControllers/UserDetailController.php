<?php

namespace App\Http\Controllers\Api\ApiControllers;

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\User;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
class UserDetailController extends Controller
{

   
    public function index()
    {
        // 
        return UserResource::collection(User::all());
    }

  
    public function store(Request $request)
    {

        $student= new User([
            'name'=>$request->name,
            'roll_no'=>$request->roll_no,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'gender'=>$request->gender,
            'dob'=>$request->dob,
            'address'=>$request->address,
            'contact'=>$request->contact,
            'class'=>$request->class,

        ]);
       try{
        $student->save();
        return response()->json([
            'data'=>'student  Details stored'
        ]);
    }
    catch (\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == 1062){
            return response()->json([
                'data'=>'Data is duplicated'
            ]);
        }
        }
        
    }

    public function exportStudent() 
{
    return Excel::download(new UserExport, 'users.csv');
}

    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        //
        return new UserResource(User::findOrFail($id));        
    }

   
    public function update(Request $request, $id)
    {
        //
        // $request->validate([
        //     'productName'=>'required',
        //     'shopName'=>'required',
        //     'shopLocation'=>'required',
        //     'stock'=>'required',
        //     'price'=>'required',
        //     'description'=>'required',

        // ]);
        $student=  User::findOrFail($id);
            $student->name=$request->name;
            $student->roll_no=$request->roll_no;
            $student->email=$request->email;
            $student->password=$request->password;
            $student->gender=$request->gender;
            $student->dob=$request->dob;
            $student->address=$request->address;
            $student->contact=$request->contact;
            $student->class=$request->class;

        $student->save();
        return response()->json([
            'data'=>'Student Details updated'
        ]);
    }

    
    public function destroy($id)
    {
        //
        $student=User::findOrFail($id);
        $student->delete();
        return response()->json([
            'data'=>'Student data deleted'
        ]);
    }

}