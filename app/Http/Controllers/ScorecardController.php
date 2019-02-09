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
        return view('scorecard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sc = new Scorecard([
          'name' => $request->get('name'),
          'total_holes' => $request->get('totalHoles'),
        ]);
        $sc->save();
        $frontHoleNums = [1,2,3,4,5,6,7,8,9];

        if( $sc->total_holes == 9 ){
            return view( '/hole/createNine', compact( 'sc', 'frontHoleNums' ) );
        }
        else{
            $backHoleNums = [10,11,12,13,14,15,16,17,18];
            return view( '/hole/createEighteen', compact( 'sc','frontHoleNums', 'backHoleNums' ) );
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
        dd($scorecard->holes());


        
        if( $scorecard->total_holes == 9 ){
            return view( 'scorecard.nineShow', compact('scorecard') );
        } else {
            $frontNine = $scorecard->holes()->where('hole_number', '<=', 9)->get();
            $backNine = $scorecard->holes()->where('hole_number', '>', 9)->get();
            return view('scorecard.eighteenShow', compact('scorecard', 'frontNine', 'backNine'));
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
