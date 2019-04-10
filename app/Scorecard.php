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

    public function getAvgCourseScore($year){
        $scores=$this->scores()->whereYear('created_at', $year)->get();
        $total = $scores->sum('total');
        $scoreCount = $scores->count();
        $avg = ($total/$scoreCount)*$this->total_holes;
        return round($avg);
    }
    public function getAvgCoursePutts($year){
        $scores=$this->scores()->whereYear('created_at', $year)->get();
        $total = $scores->sum('putt');
        $scoreCount = $scores->count();
        $avg = ($total/$scoreCount);
        return round($avg);
    }
    public function getAvgCoursePars($year){
        $scoreCount=$this->scores()->whereYear('created_at', $year)->count();
        $total = $this->scores()->whereYear('created_at', $year)->where('par',0)->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function getAvgCourseBogies($year){
        $scoreCount=$this->scores()->whereYear('created_at', $year)->count();
        $total = $this->scores()->whereYear('created_at', $year)->where('par',1)->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function getAvgCourseBirdies($year){
        $scoreCount=$this->scores()->whereYear('created_at', $year)->count();
        $total = $this->scores()->whereYear('created_at', $year)->where('par',-1)->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function getAvgCourseGIRs($year){
        $scoreCount=$this->scores()->whereYear('created_at', $year)->count();
        $total = $this->scores()->whereYear('created_at', $year)->where('gir',1)->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function getAvgCourseFairways($year){
        $scoreCount=$this->scores()->whereYear('created_at', $year)->count();
        $total = $this->scores()->whereYear('created_at', $year)->where('fairway','>',0)->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function getAvgCourseFairwaysLeft($year){
        $scoreCount=$this->scores()->whereYear('created_at', $year)->where('fairway','>',0)->count();
        $total = $this->scores()->whereYear('created_at', $year)->where('fairway','=',1)->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function getAvgCourseFairwaysRight($year){
        $scoreCount=$this->scores()->whereYear('created_at', $year)->where('fairway','>',0)->count();
        $total = $this->scores()->whereYear('created_at', $year)->where('fairway','=',2)->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function getAvgCourseFairwaysCenter($year){
        $scoreCount=$this->scores()->whereYear('created_at', $year)->where('fairway','>',0)->count();
        $total = $this->scores()->whereYear('created_at', $year)->where('fairway','=',3)->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function getAvgCourseSand($year){
        $scores=$this->scores()->whereYear('created_at', $year)->get();
        $total = $scores->sum('sand');
        $scoreCount = $scores->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
    public function getAvgCoursePenalty($year){
        $scores=$this->scores()->whereYear('created_at', $year)->get();
        $total = $scores->sum('penalty');
        $scoreCount = $scores->count();
        $avg = number_format(($total/$scoreCount)* 100, 0 );
        return $avg;
    }
}
