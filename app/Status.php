<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class status extends Model
{
    public function customers()
    {
       return $this->hasMany('App\Customer');
    }
}
