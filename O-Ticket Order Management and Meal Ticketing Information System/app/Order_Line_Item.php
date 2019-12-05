<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Line_Item extends Model
{
    protected $fillable = [
        'order_id',
        'item_id',
        'status',
        'date_redeemed',
        'meal_id'
    ];
    //Table Name
    protected $table = 'order_line_item';
    public $timestamps = false;
    //Primary Key
    public $primaryKey ='order_line_id';
}
