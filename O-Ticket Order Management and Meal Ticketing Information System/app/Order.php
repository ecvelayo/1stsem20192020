<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'patron_id',
        'order_datetime',
        'status'
    ];
    //Table Name
    protected $table = 'order';

    //Primary Key
    public $primaryKey ='order_id';
    public function patron(){
        return $this->hasOne('App\Patron', 'patron_id');
    }

    public $timestamps = false;
}
