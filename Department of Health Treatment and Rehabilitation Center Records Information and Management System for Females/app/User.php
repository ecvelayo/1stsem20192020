<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'department', 'designation'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user_role()
    {
        return $this->belongsTo('App\User_roles', 'role');
    }

    // public function user_department()
    // {
    //     return $this->belongsTo('App\Departments', 'department');
    // }

    public function user_departments()
    {
        return $this->hasMany('App\User_departments', 'user_id', 'id');
    }

    public function designation()
    {
        return $this->belongsTo('App\User_roles', 'designation');

    }
}
