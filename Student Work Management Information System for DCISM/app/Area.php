<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name'
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

}
