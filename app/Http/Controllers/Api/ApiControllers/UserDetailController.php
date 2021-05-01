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
        $user=User::all()->sortByDesc('id');
        return UserResource::collection($user);
    }

    public function getStudentsByClass(Request $request ,$id){
        $students=  User::all()->where('class',$id)->sortByDesc('id');

        // if($students!== null){
        //     return response()->json([
        //         'data'=>'No student on this class'
        //     ]);
    
        // }
        return  UserResource::collection($students);        


    }
   
    public function store(Request $request)
    {
        $student= new User([
            'name'=>$request->name,
            'username'=>$request->username,
            'roll_no'=>$request->roll_no,
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
                    'data'=>"duplicate"
                ]);
            }
        }
        
    }

    public function exportStudent() 
{
    return Excel::download(new UserExport, 'users.csv');
}

public function importStudent() 
{
    
}

    public function show($id)
    {
        //
    }

  
   
    public function getOne(Request $request, $id){
       
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
            $student->username=$request->username;
            $student->roll_no=$request->roll_no;
            $student->password=$request->password;
            $student->gender=$request->gender;
            $student->dob=$request->dob;
            $student->address=$request->address;
            $student->contact=$request->contact;
            $student->class=$request->class;

       try{
        $student->save();
        return response()->json([
            'data'=>'Student Details updated'
        ]);

       }

        catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return response()->json([
                    'data'=>"duplicate"
                ]);
            }
        }
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