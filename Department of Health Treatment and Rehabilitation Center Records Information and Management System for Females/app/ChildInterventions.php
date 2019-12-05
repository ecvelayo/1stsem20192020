<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\IntervenDept;
use App\Interventions;

class ChildInterventions extends Model
{
 
    protected $fillable = ['id','parent','interven_name','descrp'];

    public function parent(){
    	 return $this->belongsTo('App\Interventions','parent');
    }
}
