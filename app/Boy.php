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
          'Monday',
          'Wednesday',
          'Friday',
          'Outing'
      ];
      public function shots(){
          return $this->hasMany('App\Shot');
      }

      public static function getMondays(){
          $mondays = Boy::where('Monday',1)->orderBy('last_name')->get();
          return $mondays;
      }

      public static function getWednesdays(){
          $wednesdays = Boy::where('Wednesday',1)->orderBy('last_name')->get();
          return $wednesdays;
      }

      public static function getFridays(){
          $fridays = Boy::where('Friday',1)->orderBy('last_name')->get();
          return $fridays;
      }

      public static function getOutings(){
          $outings = Boy::where('Outing',1)->orderBy('last_name')->get();
          return $outings;
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
          $shots = Shot::where('boy_id',$this->id)->where('day','Monday')->get();
          $roundsPlayed = $shots->count();
          $boyAvg = $shots->sum('total');
          if( $roundsPlayed != 0){
              $boyAvg = round($boyAvg/$roundsPlayed);
          }
          return $boyAvg;
      }

      public function wednesdayBoyAverage(){
          $shots = Shot::where('boy_id',$this->id)->where('day','Wednesday')->get();
          $roundsPlayed = $shots->count();
          $boyAvg = $shots->sum('total');
          if( $roundsPlayed != 0){
              $boyAvg = round($boyAvg/$roundsPlayed);
          }
          return $boyAvg;
      }

      public function fridayBoyAverage(){
          $shots = Shot::where('boy_id',$this->id)->where('day','Friday')->get();
          $roundsPlayed = $shots->count();
          $boyAvg = $shots->sum('total');
          if( $roundsPlayed != 0){
              $boyAvg = round($boyAvg/$roundsPlayed);
          }
          return $boyAvg;
      }

      public function outingBoyAverage(){
          $shots = Shot::where('boy_id',$this->id)->where('day','Outing')->get();
          $roundsPlayed = $shots->count();
          $boyAvg = $shots->sum('total');
          if( $roundsPlayed != 0){
              $boyAvg = round($boyAvg/$roundsPlayed);
          }
          return $boyAvg;
      }

      public function behindMonLeader($leader){
          $strokes = round((($this->mondayBoyAverage() - $leader->mondayBoyAverage()) * 0.8));
          // dd($leader->mondayBoyAverage());
          if($strokes < 0){
              $strokes = 0;
          }
      return $strokes;
      }

      public function behindWedLeader($leader){
          $strokes = round((($this->wednesdayBoyAverage() - $leader->wednesdayBoyAverage()) * 0.8));
          if($strokes < 0){
              $strokes = 0;
          }
      return $strokes;
      }

      public function behindFriLeader($leader){
          $strokes = round((($this->fridayBoyAverage() - $leader->fridayBoyAverage()) * 0.8));
          if($strokes < 0){
              $strokes = 0;
          }
      return $strokes;
      }

      public function behindOutLeader($leader){
          $strokes = round((($this->outingBoyAverage() - $leader->outingBoyAverage()) * 0.8));
          if($strokes < 0){
              $strokes = 0;
          }
      return $strokes;
      }



      public static function getMonLeader(){
          $leader = Boy::findOrFail(1);
          $leaderAvg = 1000;
          $boys = Boy::getMondays();
          foreach ($boys as $key => $boy) {
              $boyAvg = $boy->mondayBoyAverage();
              // echo $boyAvg;
              if($boyAvg != 0){
                  if($boyAvg < $leaderAvg) {
                      $leaderAvg = $boyAvg;
                      $leader = $boy;
                  }
              }
          }
          return $leader;
      }

      public static function getWedLeader(){
          $leader = Boy::findOrFail(1);
          $leaderAvg = 1000;
          $boys = Boy::getWednesdays();
          foreach ($boys as $key => $boy) {
              $boyAvg = $boy->wednesdayBoyAverage();
              // echo $boyAvg;
              if($boyAvg != 0){
                  if($boyAvg < $leaderAvg) {
                      $leaderAvg = $boyAvg;
                      $leader = $boy;
                  }
              }
          }
          return $leader;
      }


      public static function getFriLeader(){
          $leader = Boy::findOrFail(1);
          $leaderAvg = 1000;
          $boys = Boy::getFridays();
          foreach ($boys as $key => $boy) {
              $boyAvg = $boy->fridayBoyAverage();
              // echo $boyAvg;
              if($boyAvg != 0){
                  if($boyAvg < $leaderAvg) {
                      $leaderAvg = $boyAvg;
                      $leader = $boy;
                  }
              }
          }
          return $leader;
      }

      public static function getOutLeader(){
          $leader = Boy::findOrFail(1);
          $leaderAvg = 1000;
          $boys = Boy::getOutings();
          foreach ($boys as $key => $boy) {
              $boyAvg = $boy->outingBoyAverage();
              // echo $boyAvg;
              if($boyAvg != 0){
                  if($boyAvg < $leaderAvg) {
                      $leaderAvg = $boyAvg;
                      $leader = $boy;
                  }
              }
          }
          return $leader;
      }

}
