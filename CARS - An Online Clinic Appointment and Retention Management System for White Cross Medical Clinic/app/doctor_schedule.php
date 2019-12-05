<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class doctor_schedule extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'doctor_id',
        'day',
        'start_time',
        'end_time'
    ];

    protected $table = 'doctor_schedules';
    public $primaryKey = 'doctor_schedule_id';
    protected $dates = ['deleted_at'];

    public function doctor()
    {
        return $this->hasOne('App\user', 'id', 'doctor_id'); 
    }
}
