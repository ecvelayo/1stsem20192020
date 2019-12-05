<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit_History extends Model
{
    //Table Name
    protected $table = 'credit_history';
    public $timestamps = false;
    //Primary Key
    public $primaryKey ='datetime_earned';
}
