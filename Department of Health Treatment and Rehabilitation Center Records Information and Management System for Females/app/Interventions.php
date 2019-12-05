<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\IntervenDept;
use App\Visit_interven;

class Interventions extends Model
{
 
    protected $fillable = ['id','interven_name','descrp','department_id','inactive'];

     public function deptxs()
    {
        return $this->belongsTo('App\Departments','department_id');
    }

}

