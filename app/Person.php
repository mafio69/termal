<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class person extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'imie', 'email', 'nazwisko','customer_id', 'address', 'phone', 'phone2', 'user_id'
    ];

    
     public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
    public function events()
    {
        return $this->hasMany('App\Event');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
