<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    protected $fillable = [
    	'user_id', 'product_id',
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
