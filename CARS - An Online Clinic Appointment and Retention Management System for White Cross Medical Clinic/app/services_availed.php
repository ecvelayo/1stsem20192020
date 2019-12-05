<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class services_availed extends Model
{
    use SoftDeletes;
    
    protected $table = 'services_availed';
    public $primaryKey = 'services_availed_id';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function services_availed_lines()
    {
        return $this->hasMany('App\services_availed_lines', 'services_availed_id', 'services_availed_id');
    }

    public function patient()
    {
        return $this->hasOne('App\User', 'id', 'patient_id'); 
    }

    public function staff()
    {
        return $this->hasOne('App\User', 'id', 'staff_id'); 
    }
}
