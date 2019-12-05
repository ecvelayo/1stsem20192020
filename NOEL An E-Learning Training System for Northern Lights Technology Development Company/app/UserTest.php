<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    protected $fillable = ['enrolled_training_id','test_id','score', 'checked'];    
}
