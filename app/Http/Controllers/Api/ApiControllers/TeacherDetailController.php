<?php

namespace App\Http\Controllers\Api\ApiControllers;

use Illuminate\Http\Request;
use App\Http\Resources\Teacher as TeacherResource;
use App\Http\Resources\ClassTeacher as ClassTeacherResource;

use App\Teacher;
use App\ClassTeacher;
use App\Subjects;


class TeacherDetailController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        $teacher=Teacher::all()->sortByDesc('id');
        return TeacherResource::collection($teacher);
    }

    public function store(Request $request)
    {

        $teacher= new Teacher([
            'name'=>$request->name,
            'username'=>$request->username,
            'password'=>bcrypt($request->password),
            'address'=>$request->address,
            'contact'=>$request->contact,

        ]);
        try{
            $teacher->save();
        return response()->json([
            'data'=>'Teachers  Details stored'
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
    public function getOne(Request $request, $id){
       
        return new TeacherResource(Teacher::findOrFail($id));        


    }
   
    public function updateTeacher(Request $request, $id)
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
        $teacher=  Teacher::findOrFail($id);
            $teacher->name=$request->name;
            $teacher->username=$request->username;
            $teacher->password=$request->password;
            $teacher->address=$request->address;
            $teacher->contact=$request->contact;

            try{
                $teacher->save();
            return response()->json([
                'data'=>'Teachers  Details stored'
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

    public function deleteTeacher($id)
    {
        //
        $teacher=Teacher::findOrFail($id);
        $teacher->delete();
        return response()->json([
            'data'=>'Teacher data deleted'
        ]);
    }
//Class Teacher
    public function getClassTeacher(Request $request)
    {
        return ClassTeacherResource::collection(ClassTeacher::all());

    }

    public function storeClassTeacher(Request $request)
    {

        $teacher= new ClassTeacher([
            'teacher_id'=>$request->teacher_id,
            'class'=>$request->class,

        ]);
        $teacher->save();
        return response()->json([
            'data'=>'Teachers  Details stored'
        ]);
    }
   
    public function deleteClassTeacher($id)
    {
        //
        $teacher=ClassTeacher::findOrFail($id);
        $teacher->delete();
        return response()->json([
            'data'=>'Class Teacher deleted'
        ]);
    }


    public function allSubj()
    {
        // 
        $subject= new Subjects();
        $subject =$subject->orderBy('id','desc')->get();
         return response()->json([
            'data'=>$subject,
        ]);
    }

    public function storeSubject(Request $request)
    {


        $subject= new Subjects([
            'name'=>$request->subjectName,
        ]);

        $subject->save();
        return response()->json([
            'data'=>'Subjects stored'
        ]);
    }
    
    public function updateSubj(Request $request, $id)
    {
      
        $subject=  Subjects::findOrFail($id);
            $subject->name=$request->name;

        $subject->save();
        return response()->json([
            'data'=>'Subject  updated'
        ]);
    }

    public function deleteSubj($id)
    {
        //
        $subject=Subjects::findOrFail($id);
        $subject->delete();
        return response()->json([
            'data'=>'Subject deleted'
        ]);
    }

    
}