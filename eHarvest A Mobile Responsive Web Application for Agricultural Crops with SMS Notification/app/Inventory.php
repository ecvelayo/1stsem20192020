<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $fillable = [
    	'product_id', 'quantity', 'unit', 'price', 'date_stocked',
    ];

    public function products()
    {

        return $this->belongsTo(Product::class,'product_id');
    }
}
