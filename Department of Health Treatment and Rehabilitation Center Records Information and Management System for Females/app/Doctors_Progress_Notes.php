<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctors_Progress_Notes extends Model
{
    protected $fillable = [
    	'progress_id','doctor_id','patient_id','date_time','notes',
    ];

    public function patientx()
    {
        return $this->belongsTo('App\Patients','patient_id');
    }

    public function userx()
    {
        return $this->belongsTo('App\Users','doctor_id');
    }
}
