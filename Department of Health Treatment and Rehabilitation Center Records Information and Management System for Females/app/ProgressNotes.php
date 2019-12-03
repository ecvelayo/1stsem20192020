<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgressNotes extends Model
{
    protected $fillable = [
        'progress_id','date_time', 'service_id', 'note_by', 'patient_id','notes', 'role_type', 'tooth_no', 'service_rendered', 'diagnose'
    ];

    public function patientx()
    {
        return $this->belongsTo('App\Patients','patient_id');
    }

    public function userx()
    {
        return $this->belongsTo('App\Users','note_by');
    }
    public function servicex()
    {
        return $this->belongsTo('App\Services','service_id');
    }
    public function remarks_by()
    {
        return $this->belongsTo('App\Users','remarks_by');
    }
}
