<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class services_availed_lines extends Model
{
    protected $table = 'services_availed_lines';

    protected $fillable = [
        'services_availed_id',
        'medical_service_id',
        'appointment_id'
    ];

    public function services_availed()
    {
        return $this->belongsTo('App\services_availed', 'services_availed_id', 'services_availed_id'); 
    }

    public function medical_service()
    {
        return $this->hasOne('App\medical_service', 'medical_service_id', 'medical_service_id'); 
    }

    public function appointment()
    {
        return $this->hasOne('App\appointment', 'appointment_id', 'appointment_id'); 
    }
}
