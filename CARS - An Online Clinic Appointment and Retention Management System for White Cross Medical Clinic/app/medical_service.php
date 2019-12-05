<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class medical_service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'description',
        'rate'
    ];

    protected $primaryKey = 'medical_service_id';
}
