<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Visit_interven;


class Events extends Model
{
 
  protected $fillable = ['evt_id','title','status','venue','start','end', 'description','start_date', 'end_date', 'start_time', 'end_time','color','department_id'];


  public function Departments()
    {
        return $this->belongsTo('App\Departments','department_id');
    }

    public function interven()
    {
        return $this->hasMany(Visit_interven::class,'event_id');
    }

}
