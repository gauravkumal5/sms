<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Marks extends JsonResource
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
            'report_details_id'=>$this->report_details_id,
            'terminal'=>$this->terminal,
            'subject_name'=>$this->subject_name,
            'theory_full'=>$this->theory_full,
            'prac_full'=>$this->prac_full,
            'theory_marks'=>$this->theory_marks,
            'prac_marks'=>$this->prac_marks,
        ];
    }
}