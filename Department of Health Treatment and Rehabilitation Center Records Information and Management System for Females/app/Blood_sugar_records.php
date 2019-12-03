<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blood_sugar_records extends Model
{
       protected $fillable = [
        'patient_id','dateTime','reading','notes','created_by'
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
