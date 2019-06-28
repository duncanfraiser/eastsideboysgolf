<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shot extends Model
{
    use SoftDeletes;
    protected $fillable = [
          'boy_id',
          'day',
          'total',
          'skin',
      ];

      public function golfer(){
          return $this->belongsTo('App\Boy');
      }
      public function Round(){
          return $this->belongsTo('App\Boy');
      }

}
