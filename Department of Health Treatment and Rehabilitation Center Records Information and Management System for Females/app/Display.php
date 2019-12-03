<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services;
use App\User_roles;


class Display extends Model
{
	
	protected $table = 'display';

	protected $fillable = [
    	'service_id','role',
    ];

    public function services()
	{
	  return $this->belongsTo('App\Services', 'service_id');
	}

	 public function rolesxe()
	{
	  return $this->belongsTo('App\User_roles', 'role');
	}
}
