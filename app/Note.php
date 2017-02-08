<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\customers;

class note extends Model
{
   public function customer()
    {
        return $this->belongsTo('App\customer');
    }
}
