<?php

namespace App\Http\Controllers\Api\ApiControllers;

use App\Http\Resources\EventInteractors as InteractorsResource;
use Illuminate\Http\Request;
use App\EventInteractors;

class EventInteractorsController extends Controller
{
    public function index()
    {
        return InteractorsResource::collection(EventInteractors::all());
    }
    public function store(Request $request){
        $interactors= new EventInteractors([
            'user_id'=>$request->user_id,
            'eventCategory'=>$request->eventCategory,
            'schoolHouse'=>$request->schoolHouse,
            'participationStatus'=>$request->participationStatus,
            
        ]);
        
        try{
            $interactors->save();
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
//     public function interactorsExport() 
// {
//     return Excel::download(new EventInteractors, 'eventinteractors.csv');
// }

}