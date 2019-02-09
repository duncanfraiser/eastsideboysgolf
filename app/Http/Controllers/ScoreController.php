<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Score;
use App\Course;
use App\Round;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::get();
        dd($courses);
        return view('score.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($round)
    {
        // dd($round);
        // return view('score.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $holeNumbers = $request->get('holeNumbers');
        $scores = $request->get('scores');
        $girs = $request->get('GIRs');
        $fairways = $request->get('fairways');
        $penalties = $request->get('penalties');
        $roundId = $request->get('roundId');
        foreach ($scores as $key => $score) {
            $score = new Score;
            $score->round_id = $roundId;
            $score->hole_num = $holeNumbers[$key];
            $score->total = $scores[$key];
            if($girs!=null){
                foreach($girs as $gir){
                    if($gir == $score->hole_num ){
                        $score->gir = 1;
                    }
                }
            }
            if($fairways!=null){
                foreach($fairways as $fairway){
                    if($fairway == $score->hole_num ){
                        $score->fairway = 1;
                    }
                }
            }
            if($penalties!=null){
                foreach($penalties as $penalty){
                    if($penalty == $score->hole_num ){
                        $score->penalty = 1;
                    }
                }
            }
            $score->save();
        }
        $round=Round::findOrFail($roundId);
        $round->total_score = array_sum($scores);
        $round->save();
        return redirect('/round/'.$roundId);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
