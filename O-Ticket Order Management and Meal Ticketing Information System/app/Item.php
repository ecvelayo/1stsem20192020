<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //Table Name
    protected $table = 'item';

    //Primary Key
    public $primaryKey ='item_id';

    public $timestamps = false;
}
