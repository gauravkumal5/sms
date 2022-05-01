<?php

namespace App\Http\Controllers\Api\ApiControllers;

use App\Marks; 
use App\ReportDetails;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ReportDetails as ReportDetailsResource;
use App\Http\Resources\UserReports as UserReportsResource;

use App\User;
use Carbon\Carbon;


use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function addReport(Request $request)  {
        $reports= $request->all();
        $u_id=$request['user_id'];
        $details= new ReportDetails();
        $details->user_id=$u_id;
        $details->term=$request['terminal'];
        $details->school_days=$request['school_days'];
        $details->present_days=$request['present_days'];
        $details->teacher_comment=$request['teacher_comment'];

        $details->save();

        $report= new ReportDetails();
       $rep_id= $report->where('user_id',$u_id)->latest()->first()->id ;
          
       try{
        foreach($reports['marksList']  as $report){
            $marks = new Marks();
            $marks->report_details_id=$rep_id;
            $marks->terminal=$request['terminal'];
            $marks->subject_name=$report['subject_name'];
            $marks->theory_full=$report['theory_full'];
            $marks->prac_full=$report['prac_full'];
            $marks->theory_marks=$report['theory_marks'];
            $marks->prac_marks=$report['prac_marks'];
            $marks->save();
        }
       

          return response()->json([
                    'data'=>'Stored'
                ]);
       }
        catch(Exception $e){
            return response()->json([
                'data'=>'Failed'
            ]);
        }
    }
    
    public function getReportAll(){
        return ReportDetailsResource::collection(ReportDetails::all());
    }

    //for past report
    // public function getLatestReport(Request $request ,$id){
    //     $reports=ReportDetails::all()->filter(function($report) use ($id) {
    //         $recent = Carbon::now();
    //         $recent->subMonth();

    //         if ($recent< $report['created_at'] &&  $report['user_id']==$id) {
              
    //             return $report;
    //           }
    //     });
    //     $reports= $reports->sortByDesc('created_at');
    //     return ReportDetailsResource::collection($reports);

    // }

    //for student profile
    public function getLatestReport(Request $request ,$id){
        $reports= new ReportDetails();
        $recent = Carbon::now();
            $recent->subMonth(2);
        $report= $reports->where('user_id',$id);
        $report= $report->where('created_at','>',$recent)->orderBy('created_at', 'desc')->take(1)->first();


        if($report===null){
            return response()->json(['data'=>"empty"]);

    }

       else{
           $report_id=$report->id;
        return new ReportDetailsResource($reports->findOrFail($report_id));  

       }
    }
//
    public function getLatestReports(Request $request, $id){
        $recent = Carbon::now();
            $recent->subMonth(2);
        $reports = ReportDetails::join('users', 'users.id', '=', 'report_details.user_id')
                ->join('class_teachers', 'users.class', '=', 'class_teachers.class')
               ->where(['class_teachers.teacher_id'=> $id,])
               ->where('report_details.created_at','>',$recent)
               ->orderBy('created_at', 'desc')
               ->get(['report_details.*','users.name','users.class','users.roll_no'])
               ;
               return response()->json(['data'=>$reports]);
        // return  ReportDetailsResource::collection($reports);        

    }
    public function getPastReports(Request $request, $id){
        $recent = Carbon::now();
            $recent->subMonth(2);
        $recentYear = Carbon::now();
            $recentYear->subYear();

        $reports = ReportDetails::join('users', 'users.id', '=', 'report_details.user_id')
                ->join('class_teachers', 'users.class', '=', 'class_teachers.class')
               ->where(['class_teachers.teacher_id'=> $id,])
               ->where('report_details.created_at','<',$recent)
               ->where('report_details.created_at','>',$recentYear)
               ->orderBy('user_id', 'desc')
               ->get(['report_details.*','users.name','users.class','users.roll_no'])
               ;
               return response()->json(['data'=>$reports]);
        // return  ReportDetailsResource::collection($reports);        

    }
    
    public function getTeacherStudent(Request $request, $id){
        $users = User::join('class_teachers', 'users.class', '=', 'class_teachers.class')
               ->where(['class_teachers.teacher_id'=> $id])
               ->get(['users.id','users.name',])
               ;
               return response()->json(['data'=>$users]);
    }
    
    public function getReport(Request $request ,$id){
        return new ReportDetailsResource(ReportDetails::findOrFail($id));        


    }
    public function getReports(Request $request ,$id){
        // return $id;
        $reports=  ReportDetails::all()->where('user_id',$id);
        return  ReportDetailsResource::collection($reports);        


    }
   
    
   
    
    public function update(Request $request , $id){
        $reports= $request->all();
        $details=  ReportDetails::findOrFail($id);
        $details->user_id=$request->user_id;
        $details->term=$request->term;
        $details->school_days=$request->school_days;
        $details->present_days=$request->present_days;
        $details->teacher_comment=$request->teacher_comment;
        $details->save();
        //delete previous marksList
        $marks = new Marks();
        $marksList= $marks->where('report_details_id',$id);
           $marksList->delete();
        //store new edited marks
        try{
            foreach($reports['marks']  as $report){
                $marks = new Marks();
                $marks->report_details_id=$id;
                $marks->terminal=$request['term'];
                $marks->subject_name=$report['subject_name'];
                $marks->theory_full=$report['theory_full'];
                $marks->prac_full=$report['prac_full'];
                $marks->theory_marks=$report['theory_marks'];
                $marks->prac_marks=$report['prac_marks'];
                $marks->save();
            }
           
    
              return response()->json([
                        'data'=>'updated'
                    ]);
           }
            catch(Exception $e){
                return response()->json([
                    'data'=>'Failed to update'
                ]);
            }
        }
        public function deleteReport($id)
        {
            //
            $details=  ReportDetails::findOrFail($id);
            $details->delete();
            return response()->json([
                'data'=>'Report data deleted'
            ]);
        }
      

}//ending of class