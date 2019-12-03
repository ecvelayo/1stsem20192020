<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Display;
use App\Notify;

class Services extends Model
{
	protected $fillable = [
    	'parent','description','name','inactive'
    ];

    public function display()
    {
        return $this->hasMany(Display::class,'service_id');
    }

    public function notify()
    {
        return $this->hasMany(Notify::class,'service_id');
    }
}
