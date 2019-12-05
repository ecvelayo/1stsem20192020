<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DentalNotes extends Model
{
     protected $fillable = [
    	'id','patient_id' ,'date_time','tooth_no','diagnose','service_rendered','remarks','note_by'
    ];

        public function userxk()
    {
        return $this->belongsTo('App\Users','note_by');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patients','patient_id');
    }

}
