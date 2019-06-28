<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Round;
use App\Score;
use App\Scorecard;
use App\Shot;
use App\Boy;
use App\Arch;

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
        $boys = Boy::orderBy('first_name')->get();
        $scorecards = Scorecard::orderBy('name')->get();
        $archDates = Arch::pluck('yr');
        return view('round.index', compact('rounds', 'boys', 'scorecards', 'archDates'));
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
        $round->day = $request->get('day');
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
            $score->day = $round->day;
            $score->scorecard_id = $round->scorecard_id;
            $score->hole_num = $holeNumbers[$key];
            $score->par = $scores[$key] - $pars[$key];
            $score->total = $scores[$key];
            $score->putt = $putts[$key];
            if(($pars[$key]-2) == ($scores[$key] - $putts[$key])){
                $score->gir = 1;
            } else {
                $score->gir = 0;
            }
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

            $score->save();
        }
        $round->total_score = array_sum($scores);
        $round->save();

        $shot = new Shot;
        $shot->boy_id = 1;
        $shot->round_id = $round->id;
        $shot->scorecard_id = $round->scorecard_id;
        $shot->day = $round->day;
        $shot->total = $round->total_score;
        $shot->skin = $request->get('skins');
        $shot->save();

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
        $shot = Shot::where('round_id',$id)->first();
        $scorecard = Scorecard::findOrFail($round->scorecard_id);

        if($scorecard->total_holes == 9){
            return view('round.showNine', compact('round', 'scorecard', 'shot'));
        }else{
            $frontNine = $scorecard->holes()->where('hole_number', '<=', 9)->get();
            $backNine = $scorecard->holes()->where('hole_number', '>', 9)->get();
            return view('round.showEighteen', compact('round', 'scorecard', 'frontNine', 'backNine', 'shot'));
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
        $shot = Shot::where('round_id',$id)->first();
        $scorecard = Scorecard::findOrFail($round->scorecard_id);
        if($scorecard->total_holes != 9){
            return view('round.editEighteen', compact('round', 'scorecard', 'shot'));
        }else{
            return view('round.editNine', compact('round', 'scorecard', 'shot'));
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
        $round->day = $request->get('day');
        // $holeNumbers = $request->get('holeNumbers');
        $pars = $request->get('pars');
        $scores = $request->get('scores');
        $putts = $request->get('putts');

        $fairways = $request->get('fairways');
        $sands = $request->get('sands');
        $penalties = $request->get('penalties');
        $scorecard = $round->scorecard()->first();
        $holePars = $scorecard->holes()->pluck('par');

        foreach($round->scores()->get() as $key=>$score){

            $score->total = $scores[$key];
            $score->day = $round->day;
            $score->par = $scores[$key] - $holePars[$key];
            $score->putt = $putts[$key];
            if(($pars[$key]-2) == ($scores[$key] - $putts[$key])){
                $score->gir = 1;
            } else {
                $score->gir = 0;
            }
            $score->fairway = $fairways[$key];
            if($sands[$key] != null){
                $score->sand = $sands[$key];
            }else{
                $score->sand = 0;
            }
            if($penalties[$key] != null){
                $score->penalty = $penalties[$key];
            }else{
                $score->penalty = 0;
            }
            $score->save();
        }


        $round->total_score = array_sum($scores);

        $round->save();

        $shot = Shot::where('round_id',$id)->first();
        $shot->boy_id = 1;
        $shot->round_id = $round->id;
        $shot->day = $round->day;
        $shot->total = $round->total_score;
        $shot->skin = $request->get('skins');
        $shot->save();

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
        $round = Round::findOrFail($id);
        $round->delete();
        return redirect('/')->with('success', "Round has been deleted.");


    }


}
