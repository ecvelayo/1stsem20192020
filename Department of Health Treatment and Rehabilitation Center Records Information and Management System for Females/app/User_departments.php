<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Departments;
use App\Users;

class User_departments extends Model
{
	use Notifiable;

    protected $fillable = [
        'department_id','user_id'
    ];

     public function departmentsc()
    {
        return $this->belongsTo('App\Departments','department_id');
    }

    public function usersc()
    {
        return $this->belongsTo('App\Users','user_id');
    }

    public function departments()
    {
        return $this->belongsTo('App\Departments','department_id');
    }

}
