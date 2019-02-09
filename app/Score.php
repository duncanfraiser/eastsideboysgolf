<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'round_id',
        'hole_num',
        'total',
        'gir',
        'fairway',
        'penalty',
    ];
    public function round(){
        return $this->belongsTo('App\Round');
    }
}
