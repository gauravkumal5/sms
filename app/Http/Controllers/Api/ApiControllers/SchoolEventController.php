<?php

namespace App\Http\Controllers\Api\ApiControllers;

use App\Http\Resources\SchoolEvent as SchoolEventResource;
use Illuminate\Http\Request;
use App\SchoolEvent;
use Carbon\Carbon;


class SchoolEventController extends Controller
{
    public function index(){
        return SchoolEventResource::collection(SchoolEvent::all()->sortByDesc('id'));


    }
    public function store(Request $request)  {
        $event= new SchoolEvent([
            'title'=>$request->title,
            'eventType'=>$request->eventType,
            'startEventDate'=>$request->startEventDate,
            'endEventDate'=>$request->endEventDate,
            'eventDescription'=>$request->eventDescription,
        ]);
        try{
            $event->save();
            return response()->json([
                'data'=>'Stored'
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'data'=>'Failed to store'
            ]);
        }
    }
    public function getOne(Request $request, $id){
       
        return new SchoolEventResource(SchoolEvent::findOrFail($id));        

    }
     function update(Request $request, $id){
       
        $event=  SchoolEvent::findOrFail($id);
            $event->title=$request->title;
            $event->eventType=$request->eventType;
            $event->startEventDate=$request->startEventDate;
            $event->endEventDate=$request->endEventDate;
            $event->eventDescription=$request->eventDescription;

        $event->save();
        return response()->json([
            'data'=>'Event Updated'
        ]);
    }

    public function destroy($id)
    {
        //
        $event=SchoolEvent::findOrFail($id);
        $event->delete();
        return response()->json([
            'data'=>'Event  deleted'
        ]);
    }

    public function getOngoing(){
        $events=SchoolEvent::all()->filter(function($event){
            if ( Carbon::now() <= $event['endEventDate'] && $event['startEventDate'] <= Carbon::now()  ) {
                return $event;
              }
        });

        return SchoolEventResource::collection($events);

    }
    public function getUpcoming(){
        $events=SchoolEvent::all()->filter(function($event){
            if ( Carbon::now() < $event['startEventDate']  ) {
                return $event;
              }
        });

        return SchoolEventResource::collection($events);

    }
    public function getPast(){
        $events=SchoolEvent::all()->filter(function($event){
            if ( Carbon::now() > $event['endEventDate']  ) {
                return $event;
              }
        });

        return SchoolEventResource::collection($events);

    }
    public function getRecent(){
      
        $events=SchoolEvent::all()->filter(function($event){
            $recent = Carbon::now();
            $recent->subMonth();
            // dd($today);
            if (Carbon::now() > $event['endEventDate']  && $recent< $event['startEventDate'] ) {
                return $event;
                

              }
        });

        return SchoolEventResource::collection($events);

    }
    public function ongoingFuture(){
        $events=SchoolEvent::all()->filter(function($event){
            if (Carbon::now() <= $event['endEventDate'] ) {
                return $event;
              }
        });

        return SchoolEventResource::collection($events);

    }
    
}//ending of the class