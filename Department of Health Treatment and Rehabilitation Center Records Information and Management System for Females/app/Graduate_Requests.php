<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Graduate_Requests extends Model
{
     protected $fillable = [
    	'graduate_id','in_department','patient_id','remarks','status',
    ];

    public function graduate_departments()
    {
        return $this->belongsTo('App\Departments','in_department');
    }
}
