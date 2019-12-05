<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patron extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'phone_number',
        'patron_id',
        'patron_type'
    ];
    //Table Name
    protected $table = 'patron';
  
    //Primary Key
    public $primaryKey ='patron_id';

    public function order(){
        return $this->belongsTo('App\Order', 'patron_id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    
}
