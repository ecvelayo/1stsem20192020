<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{

    protected $fillable =[
        'meal_type'
    ];
    //Table Name
    protected $table = 'meal';

    //Primary Key
    public $primaryKey ='meal_id';

    public $timestamps = false;
}
