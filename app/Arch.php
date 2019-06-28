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
        if($scoreCount != 0){
            $avg = ($total/$scoreCount)*18;
        }else{
            $avg = 0;
        }
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
        if($scoreCount != 0){
            $avg = ($total/$scoreCount);
        }else{
            $avg = 0;
        }
        return round($avg);
    }

    public function overallBirdies(){
        $scoreCount = Score::whereYear('created_at', $this->yr)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('par',-1)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }
    public function overallPars(){
        $scoreCount = Score::whereYear('created_at', $this->yr)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('par',0)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }
    public function overallBogies(){
        $scoreCount = Score::whereYear('created_at', $this->yr)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('par',1)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }
    public function overallGIRs(){
        $scoreCount = Score::whereYear('created_at', $this->yr)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('gir',1)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }

    public function overallFairways(){
        $scoreCount=Score::whereYear('created_at', $this->yr)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('fairway','>',0)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }
    public function overallFairwaysLeft(){
        $scoreCount=Score::whereYear('created_at', $this->yr)->where('fairway','>',0)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('fairway','=',1)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }
    public function overallFairwaysRight(){
        $scoreCount=Score::whereYear('created_at', $this->yr)->where('fairway','>',0)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('fairway','=',2)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }
    public function overallFairwaysCenter(){
        $scoreCount=Score::whereYear('created_at', $this->yr)->where('fairway','>',0)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('fairway','=',3)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }
    public function overallSand(){
        $scores=Score::whereYear('created_at', $this->yr)->get();
        $total = $scores->sum('sand');
        $scoreCount = $scores->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }
    public function overallPenalty(){
        $scores=Score::whereYear('created_at', $this->yr)->get();
        $total = $scores->sum('penalty');
        $scoreCount = $scores->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }





    // STATS BY DAY
    public function getDayRounds($day){
        $rounds=Round::whereYear('created_at', $this->yr)->where('day',$day)->count();
        return($rounds);
    }

    public function getDayScoreAvg($day){
        $scores=Score::whereYear('created_at', $this->yr)->where('day',$day)->get();
        $total = $scores->sum('total');
        $scoreCount = $scores->count();
        if($scoreCount != 0){
            $avg = ($total/$scoreCount)*18;
        }else{
            $avg = 0;
        }
        return round($avg);
    }
    public function getDayPutts($day){
        $scores = Score::whereYear('created_at', $this->yr)->where('day',$day)->get();
        $total = $scores->sum('putt');
        $scoreCount = $scores->count();
        if($scoreCount != 0){
            $avg = ($total/$scoreCount);
        }else{
            $avg = 0;
        }
        return round($avg);
    }

    public function getDayBirdies($day){
        $scoreCount = Score::whereYear('created_at', $this->yr)->where('day',$day)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('day',$day)->where('par',-1)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }
    public function getDayPars($day){
        $scoreCount = Score::whereYear('created_at', $this->yr)->where('day',$day)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('day',$day)->where('par',0)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }
    public function getDayBogies($day){
        $scoreCount = Score::whereYear('created_at', $this->yr)->where('day',$day)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('day',$day)->where('par',1)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }
    public function getDayGIRs($day){
        $scoreCount = Score::whereYear('created_at', $this->yr)->where('day',$day)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('day',$day)->where('gir',1)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }

    public function getDayFairways($day){
        $scoreCount=Score::whereYear('created_at', $this->yr)->where('day',$day)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('day',$day)->where('fairway','>',0)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }
    public function getDayFairwaysLeft($day){
        $scoreCount=Score::whereYear('created_at', $this->yr)->where('day',$day)->where('fairway','>',0)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('day',$day)->where('fairway','=',1)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }
    public function getDayFairwaysRight($day){
        $scoreCount=Score::whereYear('created_at', $this->yr)->where('day',$day)->where('fairway','>',0)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('day',$day)->where('fairway','=',2)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }
    public function getDayFairwaysCenter($day){
        $scoreCount=Score::whereYear('created_at', $this->yr)->where('day',$day)->where('fairway','>',0)->count();
        $total = Score::whereYear('created_at', $this->yr)->where('day',$day)->where('fairway','=',3)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }
    public function getDaySand($day){
        $scores=Score::whereYear('created_at', $this->yr)->where('day',$day)->get();
        $total = $scores->sum('sand');
        $scoreCount = $scores->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }
    public function getDayPenalty($day){
        $scores=Score::whereYear('created_at', $this->yr)->where('day',$day)->get();
        $total = $scores->sum('penalty');
        $scoreCount = $scores->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }



}
