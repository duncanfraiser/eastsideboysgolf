@extends('layouts.template')
@section('content')
{!!Form::open(['action' => 'HoleController@store'])!!}
{!!Form::hidden('scorecardId', $sc->id)!!}
<div class="flex-center position-ref full-height">
    <div class='col-md-12 flex-center'>
        <table id='golfcard' class='form-group'>
            <tr class='red'>
                <th colspan="11" class='courseName' style="text-align: left">
                    {!!$sc->name!!}
                    <span style="font-size:14px">{!!$sc->slope_rating!!} / {!!$sc->course_rating!!}</span>
                </th>
            </tr>
             <col span="1" class="wide">
            <tr class='blue'>
                <th style="text-align: right">HOLE</th>
                @foreach($frontHoleNums as $holeNum )
                    <td>{{$holeNum}}</td>
                    {!!Form::hidden('holeNumbers[]', $holeNum)!!}
                @endforeach
                <th>OUT</th>
            </tr>
            <tr class="white">
                <th style="text-align: right">WHITE TEES</th>
                @foreach($frontHoleNums as $holeNum )
                    <td id='scoreField' style='width:100%'><input type="text" name="whites[]" required></td>
                @endforeach
                <td></td>
            </tr>
            <tr class='green'>
                <th style="text-align: right">PAR</th>
                @foreach($frontHoleNums as $holeNum )
                    <td id='scoreField' style='width:100%'><input type="text" name="pars[]" required></td>
                @endforeach
                <td></td>
            </tr>
            <tr class="white">
                <th style="text-align: right">SCORE</th>
                @foreach($frontHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr class='grey'>
                <th style="text-align: right">GIR</td>
                @foreach($frontHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr class="white">
                <th style="text-align: right">FAIRWAY</td>
                @foreach($frontHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr class='grey'>
                <th style="text-align: right">PENALTY</td>
                @foreach($frontHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr class='gold'>
                <th style="text-align: right">HANDICAP</td>
                    @foreach($frontHoleNums as $holeNum )
                        <td id='scoreField' style='width:100%'><input type="text" name="handicaps[]" required></td>
                    @endforeach
                <td></td>
            </tr>
            <tr class='button-row'>
                <th colspan="11" style="text-align:right">
                        {!!Form::submit('Create',['class'=>'btn-sm btn-primary',  'style'=>'float:right'])!!}
                    {!!Form::close()!!}
                    {!!Form::open(['method' => 'DELETE', 'route' => ['scorecard.destroy', $sc->id]])!!}
                        {!!Form::submit('Cancel', ['class' => 'btn-sm btn-secondary', 'style'=>'float:right; margin-right:10px'])!!}
                    {!!Form::close()!!}
                </th>
            </tr>
        </table>
    </div>
</div>
@endsection
