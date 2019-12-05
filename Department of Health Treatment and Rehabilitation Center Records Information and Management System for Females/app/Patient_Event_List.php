<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient_Event_List extends Model
{
    //
        public $table = "patient_event_lists";

    protected $fillable = ['id','date','event_id','patient_id','status'];


     public function events()
    {
        return $this->belongsTo('App\Events','event_id');
    }

       public function patients()
    {
        return $this->belongsTo('App\Patients','patient_id');
    }
}
