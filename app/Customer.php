<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
class customer extends Model
{
	protected $fillable = [
    	'company',  'city', 'nr','street','zip_code','province','phone_1','phone_2','phone_3','nip', 'web','email','person_id','notes',
    ];

     public function note()
    {
        return $this->hasMany('App\Note');
    }
    public function person()
    {
        return $this->hasMany('App\Person');
    }
}
