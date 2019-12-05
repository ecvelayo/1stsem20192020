<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $fillable = ['title', 'section_id', 'content', 'index', 'isTest'];

    public function test() {
        return $this->hasOne('App\Test');
    }

    public function section() {
        return $this->belongsTo('App\Section');
    }
}
