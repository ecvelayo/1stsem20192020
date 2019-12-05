<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class appointment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'appointment_id',
        'doctor_schedule_id',
        'appointment_date',
        'nurse_id',
        'patient_id',
        'status'
    ];

    protected $table = 'appointments';
    public $primaryKey = 'appointment_id';
    protected $dates = ['deleted_at'];

    public function doctor_schedule()
    {
        return $this->hasOne('App\doctor_schedule', 'doctor_schedule_id', 'doctor_schedule_id'); 
    }

    public function nurse()
    {
        return $this->hasOne('App\User', 'id', 'nurse_id'); 
    }

    public function patient()
    {
        return $this->hasOne('App\User', 'id', 'patient_id'); 
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
