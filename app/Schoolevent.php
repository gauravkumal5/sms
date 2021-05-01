<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schoolevent extends Model
{
    //
    protected $fillable=['title','eventType','startEventDate','endEventDate','eventDescription'];
}