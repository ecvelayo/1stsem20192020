<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assign_Vehicle extends Model
{
    protected $fillable = [
        'vehicle_id',
        'driver_id',
        'datetime_assigned'
        
    ];
    //Table Name
    protected $table = 'assign_vehicle';

    //Primary Key
    public $primaryKey ='assign_id';

    public $timestamps = false;
}
