<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Shot;

class Boy extends Model
{
    protected $fillable = [
          'first_name',
          'last_name',
          'monday',
          'wednesday',
          'friday',
          'outing'
      ];
      public function shots(){
          return $this->hasMany('App\Shot');
      }

      public function boyAverage() {
          $totalRounds = $this->shots()->count();
          $boyAvg = $this->shots()->get()->sum('total');
          if($totalRounds > 0){
              $boyAvg = round($boyAvg/$totalRounds);
          }
          return $boyAvg;
      }

      public function mondayBoyAverage(){
          $shots = Shot::where('boy_id',$this->id)->where('day','monday')->get();
          $roundsPlayed = $shots->count();
          $boyAvg = $shots->sum('total');
          if( $roundsPlayed != 0){
              $boyAvg = $boyAvg/$roundsPlayed;
          }
          return $boyAvg;
      }

      public function wednesdayBoyAverage(){
          $shots = Shot::where('boy_id',$this->id)->where('day','wednesday')->get();
          $roundsPlayed = $shots->count();
          $boyAvg = $shots->sum('total');
          if( $roundsPlayed != 0){
              $boyAvg = $boyAvg/$roundsPlayed;
          }
          return $boyAvg;
      }

      public function fridayBoyAverage(){
          $shots = Shot::where('boy_id',$this->id)->where('day','friday')->get();
          $roundsPlayed = $shots->count();
          $boyAvg = $shots->sum('total');
          if( $roundsPlayed != 0){
              $boyAvg = $boyAvg/$roundsPlayed;
          }
          return $boyAvg;
      }

      public function outingBoyAverage(){
          $shots = Shot::where('boy_id',$this->id)->where('day','outing')->get();
          $roundsPlayed = $shots->count();
          $boyAvg = $shots->sum('total');
          if( $roundsPlayed != 0){
              $boyAvg = $boyAvg/$roundsPlayed;
          }
          return $boyAvg;
      }

      public function getMondayLeader(){
          $boys=Boy::get();
          $leader;
          $leaderAve=1000;
          foreach ($boys as $key => $boy) {
              $boyAve = $boy->mondayBoyAverage();
              if( $boyAvg != 0 && $boyAvg < $leaderAve) {
                  $leader = $boy;
                  $leaderAve;
              }
            dd($leaderAve);
          }
      }

}
