<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shot;
use App\Boy;

class ShotController extends Controller
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
        $page = $request->get('page');
        $shot = new Shot([
          'boy_id' => $request->get('boyId'),
          'day'=> $request->get('boyDay'),
          'total'=> $request->get('total'),
          'skin'=> $request->get('skin')
        ]);
        $shot->save();
        $boy = Boy::findorfail($shot->boy_id);
        if($page == 'boyShow'){
            return redirect('/boy/'.$boy->id)->with('success', $boy->first_name."'s Round has been added.");
        } else {
            return redirect('/')->with('success', $boy->first_name."'s Round has been added.");
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
        $shot= Shot::findOrFail($id);
        $boy = Boy::findOrFail($shot->boy_id);
        $shot->delete();
        return redirect('/boy/'.$boy->id)->with('success', "Score has been deleted.");;
    }
}
