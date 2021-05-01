<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventInteractors extends Model
{
    //
    protected $fillable=['user_id','eventCategory','schoolHouse','participationStatus'];
}