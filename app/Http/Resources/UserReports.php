<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ReportDetails as ReportDetailsResource;


class UserReports extends JsonResource
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
            'name'=>$this->name,
            'roll_no'=>$this->roll_no,
            'class'=>$this->class,
            'reports' => ReportDetails::collection($this->reports),


        ];
    }
}