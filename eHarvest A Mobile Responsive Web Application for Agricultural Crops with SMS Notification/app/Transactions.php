<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $fillable = [
    	'user_id', 'orders_id', 'status', 'trans_datetime','price_paid','change'
    ];
    public function orders(){
        return $this->belongsTo(Orders::class,'orders_id');
     }
     public function users(){
         return $this->belongsTo(User::class,'user_id');
     }
}
