<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['test_id', 'question', 'correct', 'options'];

    // public function answers() {
    //     return $this->hasMany('App\Answers');
    // }
}
