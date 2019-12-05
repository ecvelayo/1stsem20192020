<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class medical_history extends Model
{
    use SoftDeletes;

    protected $table = 'medical_histories';
    public $primaryKey = 'medical_history_id';

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id'); 
    }
}
