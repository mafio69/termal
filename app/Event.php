<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class event extends Model

{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'event_type_id', 'customer_id', 'person_id','project_id', 'phone', 'email', 'event_data',
        'title', 'description' ,'activ','user_id'
    ];
    
    public function event_type() {
        return $this->belongsTo('App\EventType','event_type_id');
    }
    public function customer() {
        return $this->belongsTo('App\Customer');
    }
    public function person() {
        return $this->belongsTo('App\Person');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function project()
    {
       return $this->belongsTo('App\Project');
    }
}
