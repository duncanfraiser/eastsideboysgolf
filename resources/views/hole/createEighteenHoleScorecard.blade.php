@extends('layouts.template')
@section('content')
{!!Form::open(['action' => 'HoleController@store'])!!}
{!!Form::hidden('scorecardName', $sc->name)!!}
{!!Form::hidden('scorecardCourseRating', $sc->courseRating)!!}
{!!Form::hidden('scorecardSlopeRating', $sc->slopeRating)!!}
{!!Form::hidden('scorecardTotalHoles', $sc->totalHoles)!!}
<div class="position-ref full-height" style="margin-top:3%">
    <div class='col-md-12 flex-center'>
        <table id='golfcard' class='form-group'>
            <tr class='green-back cardHeader'>
                <th colspan="11" class='courseName' style="text-align: left">
                    {!!$sc->name!!}
                    <span style="font-size:14px">{!!$sc->slopeRating!!} / {!!$sc->courseRating!!}</span>
                </th>
            </tr>
            <col span="1" class="wide">
            <tr class='blue-back'>
                <th style="text-align: right">HOLE</th>
                @foreach( $frontHoleNums as $holeNum )
                    <td>{{$holeNum}}</td>
                    {!!Form::hidden( 'holeNumbers[]', $holeNum )!!}
                @endforeach
                <td>OUT</td>
            </tr class="white-back">
            <tr class='red-back'>
                <th style="text-align: right">PAR</th>
                @foreach( $frontHoleNums as $holeNum )
                    <td id='scoreField' style='width:100%'><input type="number" name="pars[]" required></td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <th style="text-align: right">SCORE</th>
                @foreach( $frontHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <th style="text-align: right">PUTT</th>
                @foreach( $frontHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <th style="text-align: right">FAIRWAY</td>
                @foreach( $frontHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <th style="text-align: right">SAND</td>
                @foreach( $frontHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <th style="text-align: right">PENALTY</td>
                @foreach( $frontHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
        </table>
    </div>
    <div class='col-md-12 flex-center'>
        <table id='golfcard' class='form-group'>
            <col span="1" class="wide">
            <tr class='blue-back'>
                <th style="text-align: right">HOLE</th>
                @foreach( $backHoleNums as $holeNum )
                    <td>{{$holeNum}}</td>
                    {!!Form::hidden( 'holeNumbers[]', $holeNum )!!}
                @endforeach
                <th>OUT</th>
            </tr>
            <tr class='red-back'>
                <th style="text-align: right">PAR</th>
                @foreach($backHoleNums as $holeNum )
                    <td id='scoreField' style='width:100%'><input type="number" name="pars[]" required></td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <th style="text-align: right">SCORE</th>
                @foreach( $backHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <th style="text-align: right">PUTT</th>
                @foreach( $backHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <th style="text-align: right">FAIRWAY</td>
                @foreach( $backHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <th style="text-align: right">SAND</td>
                @foreach( $backHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <th style="text-align: right">PENALTY</td>
                @foreach( $backHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr class='button-row green-back'>
                <th colspan="11" style="text-align:right">
                        {!!Form::submit('Create',['class'=>'btn-sm btn-primary',  'style'=>'float:right'])!!}
                    {!!Form::close()!!}
                    <a href={!!url('/')!!} class="btn btn-primary btn-sm" style="float:right;margin-right:5px">Cancel</a>
                </th>
            </tr>
        </table>
    </div>
</div>
{!!Form::close()!!}
@endsection
