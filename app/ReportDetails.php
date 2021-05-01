<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\User;
// use App\Marks;


class ReportDetails extends Model
{
    //
    protected $fillable=['user_id','term','school_days','present_days','teacher_comment'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function marks()
    {
        return $this->hasMany('App\Marks');
    }
}