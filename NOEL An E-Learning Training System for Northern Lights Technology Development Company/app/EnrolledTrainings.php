<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrolledTrainings extends Model
{
    protected $fillable = ['training_id','user_id','current','isCompleted','dateCompleted'];

    public function training() {
        return $this->belongsTo('App\Training');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
