<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist_Status extends Model
{
   protected $fillable = [
    	'checklist_id','patient_id','department_id','has_files',
    ];
}
