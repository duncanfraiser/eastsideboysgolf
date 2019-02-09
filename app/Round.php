<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
