<?php

namespace App\Http\Controllers\Api\ApiControllers;

use Illuminate\Http\Request;
use App\Http\Resources\Teacher as TeacherResource;
use App\Teacher;
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
        return TeacherResource::collection(Teacher::all());
    }

    public function store(Request $request)
    {

        $teacher= new Teacher([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'gender'=>$request->gender,
            'dob'=>$request->dob,
            'address'=>$request->address,
            'contact'=>$request->contact,

        ]);
        $teacher->save();
        return response()->json([
            'data'=>'Teachers  Details stored'
        ]);
    }
}