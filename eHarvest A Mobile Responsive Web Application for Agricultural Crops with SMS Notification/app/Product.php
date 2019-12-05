<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // for pagination
    protected $table="products";

    protected $fillable = [
        'product_name','product_type','product_description','photo',
    ];

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    public function supplies(){
       return $this->hasMany(Supplies::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class,'units_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Orders::class,'baskets')->withPivot('quantity','price_at_current_order')->withTimestamps();
    }
    
    public function type(){
        return $this->belongsTo(Type::class,'types_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'followings')->withTimestamps();
    }
}
