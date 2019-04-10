<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scorecard;
use App\Boy;
use App\Score;
use Carbon\Carbon;
use App\Arch;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $archDates;
        $currentYear = date('Y');
        foreach (range(2016, $currentYear) as $key => $value) {
            $archDates[$key]= $value;
        }
        $archive=Arch::where('yr',$currentYear)->first();
        $scores = Score::get();
        if($scores->sum('total') > 0){
            $scoreAvg = (($scores->sum('total')/$scores->count())*18);
            $girAvg = (($scores->sum('gir')/$scores->count())*100);
            $fairwayAvg = (($scores->sum('fairway')/$scores->count())*100);
            $penaltyAvg = (($scores->sum('penalty')/$scores->count())*100);
        }else{
            $scoreAvg = 0;
            $girAvg = 0;
            $fairwayAvg = 0;
            $penaltyAvg = 0;
        }
        $joe = Boy::findOrFail(1);
        $boys = Boy::orderBy('first_name')->get();
        $mondays = Boy::getMondays();
        $wednesdays = Boy::getWednesdays();
        $fridays = Boy::getFridays();
        $outings = Boy::getOutings();
        $mondayLeader = Boy::getMonLeader();
        $wednesdayLeader = Boy::getWedLeader();
        $fridayLeader = Boy::getFriLeader();
        $outingLeader = Boy::getOutLeader();
        $scorecards = Scorecard::orderBy('name')->get();

        return view('landing.index', compact('archive','boys', 'mondays', 'wednesdays', 'fridays', 'outings', 'mondayLeader', 'wednesdayLeader', 'fridayLeader', 'outingLeader', 'scorecards', 'girAvg', 'fairwayAvg', 'penaltyAvg', 'scoreAvg', 'joe', 'archDates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
