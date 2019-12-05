<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = ['lecture_id', 'total_score', 'passing'];

    public function questions() {
        return $this->hasMany('App\Question');
    }

    public function lecture() {
        return $this->belongsTo('App\Lecture');
    }
}
