<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scorecard;
use App\Hole;

class ScorecardController extends Controller
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
        // return view('scorecard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sc=$request;
        $frontHoleNums = [1,2,3,4,5,6,7,8,9];
        if( $sc->totalHoles == 9 ){
            return view( '/hole/createNineHoleScorecard', compact( 'sc', 'frontHoleNums' ) );
        }
        else{
            $backHoleNums = [10,11,12,13,14,15,16,17,18];
            return view( '/hole/createEighteenHoleScorecard', compact( 'sc','frontHoleNums', 'backHoleNums' ) );
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
        $scorecard = Scorecard::findOrFail($id);
        if( $scorecard->total_holes == 9 ){
            return view( 'scorecard.nineShowOrInput', compact('scorecard') );
        } else {
            return view('scorecard.eighteenShowOrInput', compact('scorecard'));
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
        $scorecard = Scorecard::findOrFail($id);
        if($scorecard->total_holes!=9){
            return view('scorecard.editCardEighteen', compact('scorecard'));
        }else{
            return view('scorecard.editCardNine', compact('scorecard'));
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
        $scorecard = Scorecard::findOrFail($id);
        $scorecard->name = $request->name;
        $scorecard->course_rating = $request->course_rating;
        $scorecard->slope_rating = $request->slope_rating;
        $scorecard->save();
        $updatedPars = $request->get('updatedPars');

        foreach ($scorecard->holes as $key=>$hole) {
            $hole->par = $updatedPars[$key];
            $hole->save();
        }
        return redirect('/')->with('success', $scorecard->name.' scorecard has been updated.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $scorecard = Scorecard::findOrFail($id);
        $scorecard->delete();
        return redirect('/');
    }
}
