<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Boy;
use App\Shot;

class BoyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mondays = Boy::where('monday',1)->get();
        $wednesdays = Boy::where('wednesday',1)->get();
        $fridays = Boy::where('friday',1)->get();
        $outings = Boy::where('outing',1)->get();
        $mondayLeader = $this->getLeader($mondays);
        dd($mondayLeader);
        $wednesdayLeader;
        $fridayLeader;
        $outingLeader;





        //get Monday's leader
        // $monLeaderAvg = 1000;
        // foreach ($mondays as $key => $boy) {
        //      $boyAvg = $boy->mondayBoyAverage();
        //      echo $boy->first_name;
        //      echo $boyAvg;
        //     if( $boyAvg < $leaderAvg) {
        //         $leaderAvg = $boyAvg;
        //         $mondayLeader = $boy;
        //     }
        // }
        //
        // //get Wednesday's leader
        // $wedLeaderAvg = 1000;
        // foreach ($wednesday as $key => $boy) {
        //      $boyAvg = $boy->mondayBoyAverage();
        //      echo $boy->first_name;
        //      echo $boyAvg;
        //     if( $boyAvg < $leaderAvg) {
        //         $wedLeaderAvg = $boyAvg;
        //         $wednesdayLeader = $boy;
        //     }
        // }
        //
        // //get Monday's leader
        // $friLeaderAvg = 1000;
        // foreach ($mondays as $key => $boy) {
        //      $boyAvg = $boy->mondayBoyAverage();
        //      echo $boy->first_name;
        //      echo $boyAvg;
        //     if( $boyAvg < $leaderAvg) {
        //         $friLeaderAvg = $boyAvg;
        //         $fridayLeader = $boy;
        //     }
        // }
        // //get Monday's leader
        // $outLeaderAvg = 1000;
        // foreach ($mondays as $key => $boy) {
        //     $boyAvg = $boy->mondayBoyAverage();
        //     if( $boyAvg < $leaderAvg) {
        //         $outLeaderAvg = $boyAvg;
        //         $outingLeader = $boy;
        //     }
        // }
        // return view('boy.index', compact('mondays', 'wednesdays', 'fridays', 'outings'));
    }


    public function getLeader($boys){
        $leader;
        $leaderAvg = 1000;
        foreach ($boys as $key => $boy) {
            echo $boy->first_name;
            $boyAvg = $boy->mondayBoyAverage();
            if( $boyAvg < $leaderAvg) {
                $outLeaderAvg = $boyAvg;
                $leader = $boy;
            }
        }
        dd($leader);
        // return ($this->$leader);
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
        $boy = Boy::findOrFail($id);
        return view('boy.show', compact('boy'));
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
        $boy->first_name = $request->get('first_name');
        $boy->last_name = $request->get('last_name');
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
        $boy->save();
        return redirect('/');
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
