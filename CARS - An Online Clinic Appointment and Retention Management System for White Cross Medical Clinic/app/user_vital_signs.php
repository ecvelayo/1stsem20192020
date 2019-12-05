<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class user_vital_signs extends Model
{
    use SoftDeletes;

    protected $table = 'user_vital_signs';
    
    public function patient()
    {
        return $this->hasOne('App\User', 'id', 'patient_id'); 
    }

    public function staff()
    {
        return $this->hasOne('App\User', 'id', 'staff_id'); 
    }

    public function vital_sign()
    {
        return $this->hasOne('App\vital_sign', 'vital_sign_id', 'vital_sign_id'); 
    }
}
