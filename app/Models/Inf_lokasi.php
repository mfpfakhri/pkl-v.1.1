<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inf_lokasi extends Model
{
	protected $primaryKey = 'lokasi_ID';


	protected $table = 'inf_lokasi';
    public function paket(){
    	return @$this->hasOne('App\Models\Paket','id','lokasi_ID','id_lokasi');
    }
}
