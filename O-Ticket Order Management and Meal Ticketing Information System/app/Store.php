<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //Table Name
    protected $table = 'store';

    //Primary Key
    public $primaryKey ='store_id';
    public $timestamps = false;
}
