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

    public function shot()
    {
        return $this->hasOne('App\Shot');
    }


    public function delete(){
     $this->scores()->delete();
     $this->shot()->delete();
     return parent::delete();
    }

    public function getFrontNineScores(){
        return $this->hasMany('App\Score')->where('hole_num','<',10)->get();
    }
    public function getBackNineScores(){
        return $this->hasMany('App\Score')->where('hole_num','>',9)->get();
    }

    public function scorecard(){
        return $this->belongsTo('App\Scorecard');
    }

    public function getFrontNineTotaLScore(){
        $scores = $this->hasMany('App\Score')->where('hole_num','<',10)->get();
        $frontNineScore = $scores->sum('total');
        return $frontNineScore;
    }

    public function getBackNineTotalScore(){
        $scores = $this->hasMany('App\Score')->where('hole_num','>',9)->get();
        $backNineScore = $scores->sum('total');
        return $backNineScore;
    }

    public function getRoundScore(){
        $scores = $this->hasMany('App\Score')->get();
        $roundScore = $scores->sum('total');
        return $roundScore;
    }
    public function getFrontNinePutts(){
        $scores = $this->hasMany('App\Score')->where('hole_num','<',10)->get();
        $frontNinePutt = $scores->sum('putt');
        return $frontNinePutt;
    }
    public function getBackNinePutts(){
        $scores = $this->hasMany('App\Score')->where('hole_num','>',9)->get();
        $backNinePutt = $scores->sum('putt');
        return $backNinePutt;
    }
    public function getRoundPutts(){
        $scores = $this->hasMany('App\Score')->get();
        $roundScore = $scores->sum('putt');
        return $roundScore;
    }

    public function getFrontNinePenalty(){
        $scores = $this->hasMany('App\Score')->where('hole_num','<',10)->get();
        $frontNinePenalty = $scores->sum('penalty');
        return $frontNinePenalty;
    }
    public function getBackNinePenalty(){
        $scores = $this->hasMany('App\Score')->where('hole_num','>',9)->get();
        $backNinePenalty = $scores->sum('penalty');
        return $backNinePenalty;
    }
    public function getRoundPenalty(){
        $scores = $this->hasMany('App\Score')->get();
        $roundPenalty = $scores->sum('penalty');
        return $roundPenalty;
    }

    public function getFrontNineGIR(){
        $scores = $this->hasMany('App\Score')->where('hole_num','<',10)->get();
        $frontNineGIR = $scores->sum('gir');
        return $frontNineGIR;
    }
    public function getBackNineGIR(){
        $scores = $this->hasMany('App\Score')->where('hole_num','>',9)->get();
        $backNineGIR = $scores->sum('gir');
        return $backNineGIR;
    }

    public function getRoundGIR(){
        $scores = $this->hasMany('App\Score')->get();
        $roundGIR = $scores->sum('gir');
        return $roundGIR;
    }

    public function getFrontNineSand(){
        $scores = $this->hasMany('App\Score')->where('hole_num','<',10)->get();
        $frontNineSand = $scores->sum('sand');
        return $frontNineSand;
    }
    public function getBackNineSand(){
        $scores = $this->hasMany('App\Score')->where('hole_num','>',9)->get();
        $backNineSand = $scores->sum('sand');
        return $backNineSand;
    }

    public function getRoundSand(){
        $scores = $this->hasMany('App\Score')->get();
        $roundSand = $scores->sum('sand');
        return $roundSand;
    }

    public function getFrontNineFairways(){
        $scores = $this->hasMany('App\Score')->where('hole_num','<',10)->where('fairway','!=',0)->get();
        $frontNineFairways = $scores->count();
        return $frontNineFairways;
    }
    public function getBackNineFairways(){
        $scores = $this->hasMany('App\Score')->where('hole_num','>',9)->where('fairway','!=',0)->get();
        $backNineFairways = $scores->count();
        return $backNineFairways;
    }

    public function getRoundFairways(){
        $scores = $this->hasMany('App\Score')->get();
        $roundFairways = $scores->count();
        return $roundFairways;
    }
}
