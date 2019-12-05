<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employees extends Model
{
	use Notifiable;

    protected $fillable = ['fname','lname','mname','email','contact','designation','department','flag'];

    public function emp_department()
    {
        return $this->belongsTo('App\Departments','department');
    }

    public function emp_designation()
    {
        return $this->belongsTo('App\User_roles','designation');
    }
    
}
