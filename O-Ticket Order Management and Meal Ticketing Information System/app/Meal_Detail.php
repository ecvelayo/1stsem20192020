<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal_Detail extends Model
{
    protected $fillable = [
        'meal_id',
        'item_id'
    ];
    //Table Name
    protected $table = 'meal_detail';

    //Primary Key
    public $primaryKey ='meal_detail_id';

    public $timestamps = false;
}
