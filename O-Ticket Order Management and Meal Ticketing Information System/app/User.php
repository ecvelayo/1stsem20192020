<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'middlename', 
        'lastname', 
        'birthdate', 
        'email',
        'password',
        'user_type',
        'status',
        'date_registered'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    
    public function setPasswordAttribute($value)
    {
        /* TO HASH PASSWORD AND REHASH */
        return $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function patron(){
        return $this->hasOne('App\Patron');
    }
    protected $primaryKey = 'user_id';

    // public function get_user($id){
    //     $user = User::find($id);
    //     return $user;
    // }

    public static function get_name($id){
        $name = User::find($id);
        return $name->firstname.' '.$name->middlename.' '.$name->lastname;
    }
}
