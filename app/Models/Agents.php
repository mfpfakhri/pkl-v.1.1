<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agents extends Model
{
    public function paket(){
    	return $this->belongsTo('App\Models\Paket','id','agents_id');
    }
}
