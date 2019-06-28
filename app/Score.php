<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'round_id',
        'day',
        'scorecard_id',
        'hole_num',
        'par',
        'total',
        'putt',
        'gir',
        'fairway',
        'sand',
        'penalty',
    ];
    public function round(){
        return $this->belongsTo('App\Round');
    }

}
