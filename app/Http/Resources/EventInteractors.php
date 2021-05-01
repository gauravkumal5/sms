<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventInteractors extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id'=>$this->user_id,
            'eventCategory'=>$this->eventCategory,
            'schoolHouse'=>$this->schoolHouse,
            'participationStatus'=>$this->participationStatus,
        ];
    }
}