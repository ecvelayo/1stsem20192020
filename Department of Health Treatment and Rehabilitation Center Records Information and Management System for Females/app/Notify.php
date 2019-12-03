<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services;

class Notify extends Model
{
	protected $table = 'notify';

	protected $fillable = [
    	'service_id','role',
    ];

    public function services()
	{
	   return $this->belongsTo('Services::class');
	}

	public function rolesx()
	{
	  return $this->belongsTo('App\User_roles', 'role');
	}
}
