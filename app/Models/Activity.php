<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
 protected $table = 'activity';
 public function schedule(){
        return @$this->belongsTo('App\Models\Schedule','schedule_id');
    }
}
