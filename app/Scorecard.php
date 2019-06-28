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
        'course_rating',
        'slope_rating',
        'total_holes'
    ];
    public function holes(){
        return $this->hasMany('App\Hole');
    }

    public function rounds(){
        return $this->hasMany('App\Round');
    }

    public function scores(){
        return $this->hasMany('App\Score');
    }

    public function shots(){
        return $this->hasMany('App\Shot');
    }

    public function delete(){
     // delete all related photos
     $this->holes()->delete();
     $this->rounds()->delete();
     $this->scores()->delete();
     $this->shots()->delete();

     return parent::delete();
    }


    public function getFrontNineHoles(){
        return $this->holes()->where('hole_number', '<', 10)->get();
    }
    public function scorecard(){
        return $this->belongsTo('App\Scorecard');
    }

    public function getFrontNineScores(){
        return $this->hasMany('App\Score');
    }

    public function getAvgCourseScore($year){
        $scores=$this->scores()->whereYear('created_at', $year)->get();
        $total = $scores->sum('total');
        $scoreCount = $scores->count();
        if($scoreCount != 0){
            $avg = ($total/$scoreCount)*$this->total_holes;
        }else{
            $avg = 0;
        }
        return round($avg);
    }

    public function getAvgCoursePutts($year){
        $scores=$this->scores()->whereYear('created_at', $year)->get();
        $total = $scores->sum('putt');
        $scoreCount = $scores->count();
        if($scoreCount != 0){
            $avg = ($total/$scoreCount);
        }else{
            $avg = 0;
        }
        return round($avg);
    }

    public function getAvgCoursePars($year){
        $scoreCount=$this->scores()->whereYear('created_at', $year)->count();
        $total = $this->scores()->whereYear('created_at', $year)->where('par',0)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }

    public function getAvgCourseBogies($year){
        $scoreCount=$this->scores()->whereYear('created_at', $year)->count();
        $total = $this->scores()->whereYear('created_at', $year)->where('par',1)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }

        return $avg;
    }
    public function getAvgCourseBirdies($year){
        $scoreCount=$this->scores()->whereYear('created_at', $year)->count();
        $total = $this->scores()->whereYear('created_at', $year)->where('par',-1)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }

    public function getAvgCourseGIRs($year){
        $scoreCount=$this->scores()->whereYear('created_at', $year)->count();
        $total = $this->scores()->whereYear('created_at', $year)->where('gir',1)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }

    public function getAvgCourseFairways($year){
        $scoreCount=$this->scores()->whereYear('created_at', $year)->count();
        $total = $this->scores()->whereYear('created_at', $year)->where('fairway','>',0)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }

    public function getAvgCourseFairwaysLeft($year){
        $scoreCount=$this->scores()->whereYear('created_at', $year)->where('fairway','>',0)->count();
        $total = $this->scores()->whereYear('created_at', $year)->where('fairway','=',1)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }

    public function getAvgCourseFairwaysRight($year){
        $scoreCount=$this->scores()->whereYear('created_at', $year)->where('fairway','>',0)->count();
        $total = $this->scores()->whereYear('created_at', $year)->where('fairway','=',2)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }

    public function getAvgCourseFairwaysCenter($year){
        $scoreCount=$this->scores()->whereYear('created_at', $year)->where('fairway','>',0)->count();
        $total = $this->scores()->whereYear('created_at', $year)->where('fairway','=',3)->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }

    public function getAvgCourseSand($year){
        $scores=$this->scores()->whereYear('created_at', $year)->get();
        $total = $scores->sum('sand');
        $scoreCount = $scores->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }

    public function getAvgCoursePenalty($year){
        $scores=$this->scores()->whereYear('created_at', $year)->get();
        $total = $scores->sum('penalty');
        $scoreCount = $scores->count();
        if($scoreCount != 0){
            $avg = number_format(($total/$scoreCount)* 100, 0 );
        }else{
            $avg = 0;
        }
        return $avg;
    }

    public function getTotalPars(){
        return $this->holes()->sum('par');
    }
    public function getTotalFrontPars(){
        return $this->holes()->where('hole_number','<',10)->sum('par');
    }
    public function getTotalBackPars(){
        return $this->holes()->where('hole_number','>',9)->sum('par');
    }

}
