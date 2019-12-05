<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['title', 'training_id', 'description'];

    public function training() {
        return $this->belongsTo(Training::class);
    }

    public function lectures() {
        return $this->hasMany(Lecture::class);
    }
}
