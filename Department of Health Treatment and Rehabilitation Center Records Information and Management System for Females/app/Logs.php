<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $fillable = ['performer_id','type','action','date_time','department_id'];

    public function userz()
    {
        return $this->belongsTo('App\Users','performer_id');
    }

    public function departmentz()
    {
        return $this->belongsTo('App\Departments','department_id');
    }
}
