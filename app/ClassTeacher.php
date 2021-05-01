<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassTeacher extends Model
{
    //
    protected $fillable=['teacher_id','class'];

    public function teachers()
    {
        return $this->belongsTo('App\Teacher','teacher_id');
    }
}