<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adventures extends Model
{
	protected $primaryKey = 'id_adv';

    public function paket(){
    	return @$this->hasMany('App\Models\Paket','id_adv');
    }
}
