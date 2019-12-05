<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventAssignee extends Model
{
     protected $fillable = ['id', 'assignee_id', 'event_id'];

    public function assignee()
    {
        return $this->belongsTo('App\Users','assignee_id');
    }
    public function events()
    {
        return $this->belongsTo('App\Events','event_id');
    }

}
