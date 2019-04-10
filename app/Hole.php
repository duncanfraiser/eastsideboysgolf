<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hole extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'scorecard_id',
        'hole_number',
        'whites',
        'par',
        'handicap'
      ];

    // public function holes(){
    //     return $this->belongsTo('App\Scorecard');
    // }
}
