<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Patients;

class Departments extends Model
{
    protected $fillable = [
        'department_name','description','flag',
    ];

    public function user()
    {
    	return $this->hasMany('App\User');
    }

    public function patients()
    {
        return $this->hasMany(Patients::class,'department_id');
    }
}
