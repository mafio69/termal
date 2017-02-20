<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'customer_id',  'title', 'description','not_activ', 'user_id'
    ];

    public function customer()
    {
       return $this->belongsTo('App\Customer') ;
    }

    public function events()
    {
        return $this->hasMany('App\Event')->orderBy('event_data','desc');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
