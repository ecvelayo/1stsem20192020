<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class result extends Model
{
    use SoftDeletes;

    protected $table = 'results';
    public $primaryKey = 'result_id';

    public function patient()
    {
        return $this->hasOne('App\User', 'id', 'patient_id'); 
    }
}
