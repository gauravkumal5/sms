<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SchoolEvent extends JsonResource
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
            'id'=>$this->id,
            'title'=>$this->title,
            'eventType'=>$this->eventType,
            'startEventDate'=>$this->startEventDate,
            'endEventDate'=>$this->endEventDate,
            'eventDescription'=>$this->eventDescription,
        ];
    }
}