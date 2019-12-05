<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = ['title', 'description', 'skills', 'image', 'duration', 'completion', 'step', 'isFinal'];

    public function sections() {
        return $this->hasMany(Section::class)->orderBy('index', 'asc');
    }
}
