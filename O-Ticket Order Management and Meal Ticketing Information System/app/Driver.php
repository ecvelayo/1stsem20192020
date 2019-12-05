<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    

    protected $fillable = [
        'license',
        'driver_id',
        'assigned',
    ];

    //Table Name
    protected $table = 'driver';
    public $timestamps = false;
    //Primary Key
    public $primaryKey ='driver_id';
   
}
