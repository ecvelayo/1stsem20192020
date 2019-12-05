<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bloodtype extends Model
{
    protected $table = 'bloodtypes';
    public $primaryKey = 'bloodtype_id';

    public function user()
    {
        return $this->belongsTo('App\User', 'bloodtype_id', 'bloodtype_id');
    }
}
