<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conductor_Assignment extends Model
{

    protected $fillable = [
        'driver_id',
        'conductor_id',
        'date_assigned'
    ];
    //Table Name
    protected $table = 'conductor_assignment';
    public $timestamps = false;
    //Primary Key
    public $primaryKey ='con_ass_id';
}
