<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scorecard;

class Round extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'scorecard_id',
        'total_score'
      ];

    public function scores(){
        return $this->hasMany('App\Score');
    }

    public function scorecard(){
        return $this->belongsTo('App\Scorecard');
    }

    public static function bar(){
        return 99;
    }

}
