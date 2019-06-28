<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Boy;
use App\Shot;
use App\Scorecard;
use App\Arch;

class BoyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mondays = Boy::getMondays();
        $wednesdays = Boy::getWednesdays();
        $fridays = Boy::getFridays();
        $outings = Boy::getOutings();
        $mondayLeader = Boy::getMonLeader();
        $wednesdayLeader = Boy::getWedLeader();
        $firdayLeader = Boy::getFriLeader();
        $outingLeader = Boy::getOutLeader();

        return view('boy.index', compact('mondays', 'wednesdays', 'fridays', 'outings', 'mondayLeader', 'wednesdayLeader', 'firdayLeader', 'outingLeader'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('boy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $monday = $request->get('mon');
        $wednesday = $request->get('wed');
        $friday = $request->get('fri');
        $outing = $request->get('out');
        $playToPlay = $request->get('ptp');
        $boy = new Boy;
        $boy->first_name = $request->get('firstName');
        $boy->last_name = $request->get('lastName');
        if($monday != null){
            $boy->monday = $monday;
        }
        if($wednesday != null){
            $boy->wednesday = $wednesday;
        }
        if($friday != null){
            $boy->friday = $friday;
        }
        if($outing != null){
            $boy->outing = $outing;
        }
        if($playToPlay != null){
            $boy->play_To_play = $playToPlay;
        }
        $boy->save();
        return redirect('/')->with('success', $boy->first_name.' has been added to the boys.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $boys = Boy::orderBy('first_name')->get();
        $scorecards = Scorecard::orderBy('name')->get();

        $archDates = Arch::pluck('yr');


        $mondayLeader = Boy::getMonLeader();
        $wednesdayLeader = Boy::getWedLeader();
        $fridayLeader = Boy::getFriLeader();
        $outingLeader = Boy::getOutLeader();
        $boy = Boy::findOrFail($id);
        $mon = Shot::where('day','Monday')->where('boy_id',$id)->orderBy('created_at')->get();
        $wed = Shot::where('day','Wednesday')->where('boy_id',$id)->orderBy('created_at')->get();
        $fri = Shot::where('day','Friday')->where('boy_id',$id)->orderBy('created_at')->get();
        $out = Shot::where('day','Outing')->where('boy_id',$id)->orderBy('created_at')->get();
        $ptp = Shot::where('day','Play-To-Play')->where('boy_id',$id)->orderBy('created_at')->get();

        return view('boy.show', compact('archDates','scorecards','boys','boy','mon','wed','fri','out','ptp','mondayLeader','wednesdayLeader','fridayLeader','outingLeader'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $boy = Boy::findOrFail($id);
        return view('boy.edit', compact('boy'));
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
        $boy = Boy::findOrFail($id);
        $monday = $request->get('mon');
        $wednesday = $request->get('wed');
        $friday = $request->get('fri');
        $outing = $request->get('out');
        $playToPlay = $request->get('ptp');

        $boy->first_name = $request->get('first_name');
        $boy->last_name = $request->get('last_name');
        if($monday != null){
            $boy->monday = $monday;
        }else{
            $boy->monday = 0;
        }
        if($wednesday != null){
            $boy->wednesday = $wednesday;
        }else{
            $boy->wednesday = 0;
        }
        if($friday != null){
            $boy->friday = $friday;
        }else{
            $boy->friday = 0;
        }
        if($outing != null){
            $boy->outing = $outing;
        } else{
            $boy->outing = 0;
        }

        if($playToPlay != null){
            $boy->play_To_play = $playToPlay;
        } else{
            $boy->play_To_play = 0;
        }
        $boy->save();
        return redirect('/')->with('success', $boy->first_name.' has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $boy = Boy::findOrFail($id);
        $boy->delete();
        return redirect('/')->with('success', $boy->first_name." has been deleted.");;
    }

}
