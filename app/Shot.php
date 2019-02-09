<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shot extends Model
{
    protected $fillable = [
          'boy_id',
          'day',
          'total',
      ];

      public function golfer(){
          return $this->belongsTo('App\Boy');
      }


}
