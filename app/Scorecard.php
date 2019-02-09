<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Hole;

class Scorecard extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'scorecard_id',
        'name',
        'total_holes'
    ];
    public function holes(){
        return $this->hasMany('App\Hole');
    }

}
