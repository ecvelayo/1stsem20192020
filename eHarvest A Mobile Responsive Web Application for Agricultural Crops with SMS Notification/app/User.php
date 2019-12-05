<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // for pagination
    protected $table="users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'firstname', 'lastname', 'contact', 'address', 'birthdate', 'photo', 'type',
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
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(Orders::class);
    }

    public function supplies()
    {
        return $this->hasMany(Supplies::class);
    }
    public function transactions(){
        return $this->hasMany(Transactions::class);
    }
    public function routeNotificationForNexmo($notification)
    {
        return $this->contact;
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'followings')->withTimestamps();
    }
}
