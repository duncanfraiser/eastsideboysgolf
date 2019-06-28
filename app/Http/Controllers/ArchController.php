<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Arch;
use App\Score;
use App\Round;
use App\Scorecard;
use App\Day;
use App\Boy;

class ArchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('arch.index');
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
    public function show($archYear)
    {
        $days = Day::get();
        $archive=Arch::where('yr',$archYear)->first();
        $scorecards=Scorecard::orderBy('name')->get();
        $rounds = Round::get();
        $boys = Boy::orderBy('first_name')->get();
        $archDates = Arch::pluck('yr');
        return view('arch.show', compact('scorecards', 'archive', 'days', 'rounds', 'boys','archDates'));
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
