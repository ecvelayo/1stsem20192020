<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'role_id',
        'contact_no',
        'username', 
        'email', 
        'password',
        'first_name',
        'last_name',
        'middle_name',
        'sex',
        'birthday',
        'citizenship',
        'civil_status',
        'address_line_1',
        'address_line_2',
        'bloodtype_id'
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
    
    protected $table = 'users';
    public $primarykey = 'id';
    protected $dates = ['deleted_at'];
    
    public function role()
    {
        return $this->hasOne('App\role', 'role_id', 'role_id'); 
    }
    
    public function bloodtype()
    {
        return $this->hasOne('App\bloodtype', 'bloodtype_id', 'bloodtype_id'); 
    }

    public function doctor_schedule()
    {
        return $this->belongsTo('App\doctor_schedule', 'doctor_schedule_id', 'doctor_schedule_id');
    }

    public function medical_history()
    {
        return $this->belongsTo('App\medical_history', 'medical_history_id', 'medical_history_id');
    }
    
    public static function getEnumValues($column)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM users WHERE Field = '{$column}'"))[0]->Type ;
        
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        
        foreach( explode(',', $matches[1]) as $value ) {
            $v = trim( $value, "'" );
            $enum = array_add($enum, $v, $v);
        }
        
        return $enum;
    }
}
