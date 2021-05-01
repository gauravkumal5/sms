<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ReportDetails;

class Marks extends Model
{
    //
    protected $fillable=['report_details_id','terminal','subject_name','theory_full','prac_full','theory_marks','prac_marks'];

    public function report_details()
    {
        return $this->belongsTo('App\ReportDetails','report_details_id');
    }

}