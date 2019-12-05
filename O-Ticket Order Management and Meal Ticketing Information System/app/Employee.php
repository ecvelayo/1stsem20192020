<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //Table Name
    protected $table = 'employee';

    //Primary Key
    public $primaryKey ='employee_id';

    public $timestamps = false;
}
