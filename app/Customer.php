<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class customer extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	protected $fillable = [
    	'company',  'city', 'nr','street','zip_code','province','phone_1','phone_2','phone_3','nip', 'web','email','statuses_id','notes','user_id'
    ];

     public function note()
    {
        return $this->hasMany('App\Note');
    }
    public function person()
    {
        return $this->hasMany('App\Person');
    }

    public function status()
    {
        return $this->belongsTo('App\Status','statuses_id','id');
    }
    public function events()
    {
        return $this->hasMany('App\Event');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function project()
    {
       return $this->hasMany('App\Project');
    }
}
