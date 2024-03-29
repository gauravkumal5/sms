<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'username'=>$this->username,
            'password'=>$this->password,
            'gender'=>$this->gender,
            'dob'=>$this->dob,
            'address'=>$this->address,
            'contact'=>$this->contact,
            'class'=>$this->class,
            
        ];
    }
}