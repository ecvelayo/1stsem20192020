<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle_Info extends Model
{
    protected $fillable = [
        'vehicle_type',
        'plate_number',
        'owner_name'
        
    ];
    //Table Name
    protected $table = 'vehicle_info';
    public $timestamps = false;
    //Primary Key
    public $primaryKey ='vehicle_id';
    
   
}
