<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bmi_records extends Model
{
    protected $fillable = [
    	'patient_id','date','weight','bmi','remarks','created_by'
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
