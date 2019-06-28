@extends('layouts.template')
@section('content')
{!!Form::open(['action' => 'RoundController@store'])!!}
{!!Form::hidden('scorecardId', $scorecard->id)!!}
<div style="margin:10% 1%">
    <table id='golfcard' class='form-group'>
        <tr class='green-back cardHeader'>
            <th colspan="11" class='courseName' style="text-align: left">
                {!!$scorecard->name!!}
                <span style="font-size:14px">{!!$scorecard->slope_rating!!} / {!!$scorecard->course_rating!!}</span>
                <p style="text-align:left;font-size:14px"><strong>Day Group:</strong>
                  <select name="day" class="greyColor" required>
                      <option value=""><strong>Select A Day</strong></option>
                      <option value="Monday">Monday</option>
                      <option value="Wednesday">Wednesday</option>
                      <option value="Friday">Friday</option>
                      <option value="Play-To-Play">Play-To-Play</option>
                  </select>
                  <span style="text-align:right">  &nbsp;&nbsp;&nbsp;&nbsp;<strong>Skins: </strong><input type="number" name="skins" required></span>
                </p>
            </th>
        </tr>
        <col span="1" class="wide">
        <tr class='blue-back'>
            <th style="text-align: right">HOLE</th>
            @foreach ( $scorecard->holes as $hole )
                <td>{!!$hole->hole_number!!}</td>
                {!!Form::hidden('holeNumbers[]', $hole->hole_number)!!}
            @endforeach
            <td>OUT</td>
        </tr>
        <tr class='red-back'>
            <th style="text-align: right">PAR</th>
            @foreach( $scorecard->holes as $hole )
                <td id='scoreField'>{!!$hole->par!!}</td>
                {!!Form::hidden('pars[]', $hole->par)!!}
            @endforeach
            <td>{!!$scorecard->holes->sum('par')!!}</td>
        </tr>
        <tr>
            <th style="text-align: right">SCORE</th>
            @foreach( $scorecard->holes as $hole )
                <td id='scoreField' style='width:100%'><input type="number" name="scores[]" required></td>
            @endforeach
            <td></td>
        </tr>
        <tr>
            <th style="text-align: right">PUTT</th>
            @foreach( $scorecard->holes as $hole )
                <td id='scoreField' style='width:100%'><input type="number" name="putts[]" required></td>
            @endforeach
            <td></td>
        </tr>
        <tr>
            <th style="text-align: right">FAIRWAY</td>
            @foreach( $scorecard->holes as $hole )
                <td>{!!Form::select('fairways[]', ['0'=>'', '1' => 'L', '2' => 'R' ],null,['class'=>'form-control'])!!}</td>
            @endforeach
            <td></td>
        </tr>
        <tr>
            <th style="text-align: right">SAND</th>
            @foreach( $scorecard->holes as $hole )
                <td id='scoreField' style='width:100%'><input type="number" name="sands[]"></td>
            @endforeach
            <td></td>
        </tr>
        <tr>
            <th style="text-align: right">PENALTY</th>
            @foreach( $scorecard->holes as $hole )
                <td id='scoreField' style='width:100%'><input type="number" name="penalties[]"></td>
            @endforeach
            <td></td>
        </tr>
        <tr colspan="11" class="green-back">
            <td colspan="11" style="padding: 15px">
                {!!Form::submit( 'Submit Round', ['class'=>'btn btn-primary btn-sm', 'style'=>'float:right; margin:3px'] )!!}
                <a href={!!url('/scorecard/'.$scorecard->id.'/edit')!!} class="btn btn-primary btn-sm" style='float:right; margin:3px'>Edit Scorecard</a>
                <a href={!!url('/')!!} class="btn btn-primary btn-sm" style='float:right; margin:3px'>Cancel</a>
            </td>
        </tr>
    </table>
</div>
{!!Form::close()!!}
@endsection
