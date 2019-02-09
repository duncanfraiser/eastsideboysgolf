<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Round;
use App\Scorecard;

class RoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
     {
        $round = new Round([
            'scorecard_id' => $request->get('cardId'),
        ]);
        $round->save();
        $scorecard = Scorecard::findOrFail($round->scorecard_id);

        if( $scorecard->total_holes == 9 ){
            return view( 'score.createNine', compact('scorecard', 'round') );
        } else {
            $frontNine = $scorecard->holes()->where('hole_number', '<=', 9)->get();
            $backNine = $scorecard->holes()->where('hole_number', '>', 9)->get();
            return view('score.createEighteen', compact('scorecard', 'round', 'frontNine', 'backNine'));
        }
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
            return view('round.showEighteen', compact('round', 'scorecard'));
        }
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
