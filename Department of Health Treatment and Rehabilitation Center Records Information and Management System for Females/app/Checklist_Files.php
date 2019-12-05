<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist_Files extends Model
{
    protected $fillable = [
    	'checklist_id','patient_id','department_id','status','name','size','location',
    ];

    public function pats()
    {
        return $this->belongsTo('App\Patients','patient_id');
    }
} 
