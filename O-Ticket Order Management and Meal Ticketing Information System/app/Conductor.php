<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    protected $fillable = [
        'cond_experience',
        'conductor_id'
    ];
    //Table Name
    protected $table = 'conductor';
    public $timestamps = false;
    //Primary Key
    public $primaryKey ='conductor_id';
    
  
}
