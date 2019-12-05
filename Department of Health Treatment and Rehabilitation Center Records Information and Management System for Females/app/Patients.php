<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Departments;
use App\Visit_interven;

class Patients extends Model
{ 

    use Notifiable;
    
	protected $fillable = [
		'patient_id','admission_no','fname','lname','mname','age','birthdate','birthorder','address_id','contact','gender','civil_status','nationality','religion','patient_type','jail','caseno','status','date_admitted','department_id','flag', 'inactive', 'remarks'
	];

	 public function departments()
    {
        return $this->belongsTo('App\Departments','department_id');
    }

    public function address()
    {
        return $this->belongsTo('App\Address','address_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Case_Type','patient_type');
    }

    public function jails()
    {
        return $this->belongsTo('App\City_Jails','jail');
    }

    public function genders()
    {
        return $this->belongsTo('App\Gender','gender');
    }

    public function cstatus()
    {
        return $this->belongsTo('App\Civil_Status','civil_status');
    }

    public function deps()
    {
        return $this->belongsTo('Departments::class');
    }

    public function interven()
    {
        return $this->hasMany(Visit_interven::class,'patient_id');


    }



}
