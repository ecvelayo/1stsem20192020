<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    //
    protected $fillable = [
    	'orders_id', 'product_id', 'quantity',
    ];
    // public function orders()
    // {
    //     return $this->belongsTo(Orders::class);
    // }

    // public function products()
    // {
    //     return $this->belongsTo(Product::class);
    // }
}
