<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Round;
use App\Score;
use App\Scorecard;
use App\Shot;

class RoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rounds = Round::get();
        return view('round.index', compact('rounds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->validate($request,[
            'cardId' => 'required',
        ]);
        return view('round.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $round = new Round;
        $round->scorecard_id = $request->get('scorecardId');
        $round->day = 'other';
        $round->total_score = 0;
        $round->save();
        $holeNumbers = $request->get('holeNumbers');
        $pars = $request->get('pars');
        $scores = $request->get('scores');
        $putts = $request->get('putts');
        $fairways = $request->get('fairways');
        $girs = $request->get('GIRs');
        $sands = $request->get('sands');
        $penalties = $request->get('penalties');

        foreach($scores as $key => $score){
            $score = new Score;
            $score->round_id = $round->id;
            $score->scorecard_id = $round->scorecard_id;
            $score->hole_num = $holeNumbers[$key];
            $score->par = $scores[$key] - $pars[$key];
            $score->total = $scores[$key];
            $score->putt = $putts[$key];
            $score->fairway = $fairways[$key];
            if($sands[$key]!=null){
                $score->sand = $sands[$key];
            } else {
                $score->sand = 0;
            }
            if($penalties[$key]!=null){
                $score->penalty = $penalties[$key];
            } else {
                $score->penalty = 0;
            }
            if($girs!=null){
                foreach($girs as $gir){
                    if($gir == $score->hole_num ){
                        $score->gir = 1;
                    }
                }
            }
            $score->save();
        }
        $round->total_score = array_sum($scores);

        $day = $request->get('day');
        if($day!=null){
            $round->day=$day;
            $shot = new Shot;
            $shot->boy_id = 1;
            $shot->day = $day;
            $shot->total = $round->total_score;
            $shot->save();
        }
        $round->save();
        return redirect('/')->with('success', "Round has been added.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $round = Round::findOrFail($id);
        $scorecard = Scorecard::findOrFail($round->scorecard_id);
        if($scorecard->total_holes == 9){
            return view('round.showNine', compact('round', 'scorecard'));
        }else{
            $frontNine = $scorecard->holes()->where('hole_number', '<=', 9)->get();
            $backNine = $scorecard->holes()->where('hole_number', '>', 9)->get();
            return view('round.showEighteen', compact('round', 'scorecard', 'frontNine', 'backNine'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $round = Round::findOrFail($id);
        $scorecard = Scorecard::findOrFail($round->scorecard_id);
        if($scorecard->total_holes != 9){
            return view('round.editEighteen', compact('round', 'scorecard'));
        }else{
            return view('round.editNine', compact('round', 'scorecard'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $round = Round::findOrFail($id);
        $updatedScrs = $request->get('updatedScores');
        $updatedGIRs = $request->get('updatedGIRs');
        $updatedFairways = $request->get('updatedFairways');
        $updatedPenalties = $request->get('updatedPenalties');
        // reset all checks
        foreach($round->scores as $score){
            $score->gir = 0;
            $score->fairway = 0;
            $score->penalty = 0;
            $score->save();
        }
        foreach ($round->scores as $key => $score) {
            $score = Score::findOrFail($score->id);
            $score->total = $updatedScrs[$key];
            if($updatedGIRs!=null){
                foreach($updatedGIRs as $gir){
                    if($gir == $score->hole_num ){
                        $score->gir = 1;
                    }
                }
            }
            if($updatedFairways!=null){
                foreach($updatedFairways as $fairway){
                    if($fairway == $score->hole_num ){
                        $score->fairway = 1;
                    }
                }
            }
            if($updatedPenalties!=null){
                foreach($updatedPenalties as $penalty){
                    if($penalty == $score->hole_num ){
                        $score->penalty = 1;
                    }
                }
            }
            $score->save();
        }
        return redirect('/round/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
