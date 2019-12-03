<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    //
    protected $fillable = [
    	'user_id', 'status', 'order_datetime', 'obtaining_method','created_at'
    ];
    protected $table ="orders";

    public function products()
    {
        return $this->belongsToMany(Product::class,'baskets')->withPivot('quantity','price_at_current_order')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function transactions()
    {
        return $this->hasOne(Transactions::class);
    }
}
