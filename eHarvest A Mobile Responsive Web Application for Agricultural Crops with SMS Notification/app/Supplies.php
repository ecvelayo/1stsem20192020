<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplies extends Model
{
    //
    protected $fillable = [
        'user_id','product_id','expected_price','expected_quantity','expected_harvest_date',
        'expected_delivery_date','actual_quantity','status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
