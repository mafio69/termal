<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    public function event() {
       return $this->hasMany('App\Event'); 
    }  
}
