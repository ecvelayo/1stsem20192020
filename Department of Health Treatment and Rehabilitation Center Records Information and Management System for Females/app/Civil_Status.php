<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Civil_Status extends Model
{
    protected $fillable = [
    	'civilstat_id','name','flag',
    ];
}
