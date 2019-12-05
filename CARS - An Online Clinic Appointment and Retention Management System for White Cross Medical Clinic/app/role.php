<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table = 'roles';
    public $primaryKey = 'role_id';
    
    public function user()
    {
        return $this->belongsTo('App\User', 'role_id', 'role_id');
    }
}
