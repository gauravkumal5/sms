<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Marks as MarksResource;
use App\Http\Resources\User as UserResource;



class ReportDetails extends JsonResource
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
            'user_id'=>$this->user_id,
            'users' => new UserResource($this->user),
            'term'=>$this->term,
            'school_days'=>$this->school_days,
            'present_days'=>$this->present_days,
            'marks' => MarksResource::collection($this->marks),
            'teacher_comment'=>$this->teacher_comment,
        ];
    }
}