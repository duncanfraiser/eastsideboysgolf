<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Score;
use App\Round;

class Arch extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'yr',
    ];

    public function overallScore(){
        $scores=Score::whereYear('created_at', $this->yr)->get();
        $total = $scores->sum('total');
        $scoreCount = $scores->count();
        $avg = ($total/$scoreCount)*18;
        return round($avg);
    }

    public function overallRoundsPlayed(){
        $rounds = Round::whereYear('created_at', $this->yr)->count();
        return $rounds;
    }

    public function overallPutts(){
        $scores = Score::whereYear('created_at', $this->yr)->get();
        $total = $scores->sum('putt');
        $scoreCount = $scores->count();
        $avg = ($total/$scoreCount);
        return round($avg);
    }

    public function overallBirdies(){
        $scoreCount = Score::whereYear('created_at', $this->yr)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('par',-1)->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function overallPars(){
        $scoreCount = Score::whereYear('created_at', $this->yr)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('par',0)->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function overallBogies(){
        $scoreCount = Score::whereYear('created_at', $this->yr)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('par',1)->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function overallGIRs(){
        $scoreCount = Score::whereYear('created_at', $this->yr)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('gir',1)->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }

    public function overallFairways(){
        $scoreCount=Score::whereYear('created_at', $this->yr)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('fairway','>',0)->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function overallFairwaysLeft(){
        $scoreCount=Score::whereYear('created_at', $this->yr)->where('fairway','>',0)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('fairway','=',1)->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function overallFairwaysRight(){
        $scoreCount=Score::whereYear('created_at', $this->yr)->where('fairway','>',0)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('fairway','=',2)->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function overallFairwaysCenter(){
        $scoreCount=Score::whereYear('created_at', $this->yr)->where('fairway','>',0)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('fairway','=',3)->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function overallSand(){
        $scores=Score::whereYear('created_at', $this->yr)->get();
        $total = $scores->sum('sand');
        $scoreCount = $scores->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function overallPenalty(){
        $scores=Score::whereYear('created_at', $this->yr)->get();
        $total = $scores->sum('penalty');
        $scoreCount = $scores->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
}
