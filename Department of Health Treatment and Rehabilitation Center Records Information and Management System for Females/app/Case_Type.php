<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case_Type extends Model
{
    protected $fillable = [
    	'case_name','court_order',
    ];
}
