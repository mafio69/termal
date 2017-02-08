<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Person;

class person extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'imie', 'email', 'nazwisko','customer_id', 'address', 'phone', 'phone2'
    ];

    public function note()
    {
        return $this->belongsTo('App\Customer');
    }
     public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
