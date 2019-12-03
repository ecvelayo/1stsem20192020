<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medical_records extends Model
{

     protected $fillable = [
        'patient_id','intake_date','intake_time','medication','notes','created_by'
    ];

    public function patientx()
    {
        return $this->belongsTo('App\Patients','patient_id');
    }

      public function userxe()
    {
        return $this->belongsTo('App\Users','created_by');
    }



}
