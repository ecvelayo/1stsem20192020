<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;

class Patient_Intake_Information extends Model
{
    protected $fillable = [
    	'patient_id','emergency_id','educational_attainment','employment_status','spouse','father','mother','presenting_problems','impression','date',
    ];

    public function eperson()
    {
        return $this->belongsTo('App\Emergency_Persons','emergency_id');
    }

    public function eduatain()
    {
        return $this->belongsTo('App\Educational_Attainment','educational_attainment');
    }

     public function estat()
    {
        return $this->belongsTo('App\Employment_Status','employment_status');
    }


}
