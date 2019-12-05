<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Interventions;

class IntervenDept extends Model
{
	protected $table = 'interven_dept';

	protected $fillable = [
    	'department_id','interven',
    ];

    public function interven()
	{
	   return $this->belongsTo('App\Interventions', 'interven');
	}

	 public function depatmentxc()
    {
        return $this->belongsTo('App\Departments','department_id');
    }

}
