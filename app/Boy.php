<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Shot;
use Carbon\Carbon;

class Boy extends Model
{
    use SoftDeletes;
    protected $fillable = [
          'first_name',
          'last_name',
          'Monday',
          'Wednesday',
          'Friday',
          'Outing',
          'Play_To_Play'
      ];
      public function shots(){
          return $this->hasMany('App\Shot')->whereYear('created_at', Carbon::now());
      }

      public static function getMondays(){
          $mondays = Boy::where('Monday',1)->orderBy('first_name')->get();
          return $mondays;
      }

      public static function getWednesdays(){
          $wednesdays = Boy::where('Wednesday',1)->orderBy('first_name')->get();
          return $wednesdays;
      }

      public static function getFridays(){
          $fridays = Boy::where('Friday',1)->orderBy('first_name')->get();
          return $fridays;
      }

      public static function getOutings(){
          $outings = Boy::where('Outing',1)->orderBy('first_name')->get();
          return $outings;
      }

      public static function getPlayToPlay(){
          $outings = Boy::where('Play_To_play',1)->orderBy('first_name')->get();
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
          $shots = Shot::where('boy_id',$this->id)->where('day','Monday')->whereYear('created_at', Carbon::now())->get();
          $roundsPlayed = $shots->count();
          $boyAvg = $shots->sum('total');
          if( $roundsPlayed != 0){
              $boyAvg = round($boyAvg/$roundsPlayed);
          }
          return $boyAvg;
      }

      public function wednesdayBoyAverage(){
          $shots = Shot::where('boy_id',$this->id)->where('day','Wednesday')->whereYear('created_at', Carbon::now())->get();
          $roundsPlayed = $shots->count();
          $boyAvg = $shots->sum('total');
          if( $roundsPlayed != 0){
              $boyAvg = round($boyAvg/$roundsPlayed);
          }
          return $boyAvg;
      }

      public function fridayBoyAverage(){
          $shots = Shot::where('boy_id',$this->id)->where('day','Friday')->whereYear('created_at', Carbon::now())->get();
          $roundsPlayed = $shots->count();
          $boyAvg = $shots->sum('total');
          if( $roundsPlayed != 0){
              $boyAvg = round($boyAvg/$roundsPlayed);
          }
          return $boyAvg;
      }

      public function outingBoyAverage(){
          $shots = Shot::where('boy_id',$this->id)->where('day','Outing')->whereYear('created_at', Carbon::now())->get();
          $roundsPlayed = $shots->count();
          $boyAvg = $shots->sum('total');
          if( $roundsPlayed != 0){
              $boyAvg = round($boyAvg/$roundsPlayed);
          }
          return $boyAvg;
      }

      public function playToPlayBoyAverage(){
          if($this->id != 1){
              $shots = Shot::where('boy_id',$this->id)->where('day','Play-To-Play')->whereYear('created_at', Carbon::now())->get();
              $roundsPlayed = $shots->count();
              $boyAvg = $shots->sum('total');
              if( $roundsPlayed != 0){
                  $boyAvg = round($boyAvg/$roundsPlayed);
              }
          }else{
              $scores = Score::where('day','Play-To-Play')->whereYear('created_at', Carbon::now())->get();
              $holesPlayed = $scores->count();
              $boyAvg = $scores->sum('total');
              if( $holesPlayed != 0){
                $boyAvg = ($boyAvg/$holesPlayed)*18;
              }
          }
          return $boyAvg;
      }

      public function playToPlayBoySkin(){
          $shots = Shot::where('boy_id',$this->id)->where('day','Play-To-Play')->whereYear('created_at', Carbon::now())->get();
          $boySkins = $shots->sum('skin');
          return $boySkins;
      }

      public function mondayBoySkin(){
          $shots = Shot::where('boy_id',$this->id)->where('day','Monday')->whereYear('created_at', Carbon::now())->get();
          $boySkins = $shots->sum('skin');
          return $boySkins;
      }

      public function wednesdayBoySkin(){
          $shots = Shot::where('boy_id',$this->id)->where('day','Wednesday')->whereYear('created_at', Carbon::now())->get();
          $boySkins = $shots->sum('skin');
          return $boySkins;
      }

      public function fridayBoySkin(){
          $shots = Shot::where('boy_id',$this->id)->where('day','Friday')->whereYear('created_at', Carbon::now())->get();
          $boySkins = $shots->sum('skin');
          return $boySkins;
      }

      public function outingBoySkin(){
          $shots = Shot::where('boy_id',$this->id)->where('day','Outing')->whereYear('created_at', Carbon::now())->get();
          $boySkins = $shots->sum('skin');
          return $boySkins;
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

      public function behindPlayToPlayLeader($leader){
          $strokes = round((($this->playToPlayBoyAverage() - $leader->outingBoyAverage()) * 0.8));
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

      public static function getPlayToPlayLeader(){
          $leader = Boy::findOrFail(1);
          $leaderAvg = 1000;
          $boys = Boy::getPlayToPlay();
          foreach ($boys as $key => $boy) {
              $boyAvg = $boy->playToPlayBoyAverage();
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
