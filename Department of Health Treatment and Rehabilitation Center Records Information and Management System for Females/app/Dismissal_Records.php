<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dismissal_Records extends Model
{
    protected $fillable = [
    	'd_record_id','dismissal_id','patient_id','in_department','remarks',
    ];
    
    public function patientsz()
    {
        return $this->belongsTo('App\Patients','patient_id');
    }

    public function dismisz()
    {
        return $this->belongsTo('App\Dismissal_Reasons','dismissal_id');
    }

    public function departmentz()
    {
        return $this->belongsTo('App\Departments','in_department');
    }
}
