@extends('layouts.template')
@section('content')
{!!Form::open(['action' => 'HoleController@store'])!!}
{!!Form::hidden('scorecardId', $sc->id)!!}
<div class="position-ref full-height">
    <div class='col-md-12'>
        <table id='golfcard' class='form-group'>
            <tr class='red'>
                <th colspan="11" class='courseName' style="text-align: left">
                    {!!$sc->name!!}
                </th>
            </tr>
            <col span="1" class="wide">
            <tr class='blue'>
                <th style="text-align: right">HOLE</th>
                @foreach( $frontHoleNums as $holeNum )
                    <td>{{$holeNum}}</td>
                    {!!Form::hidden( 'holeNumbers[]', $holeNum )!!}
                @endforeach
                <th>OUT</th>
            </tr>
            <tr class="white">
                <th style="text-align: right">WHITE TEES</th>
                @foreach( $frontHoleNums as $holeNum )
                    <td id='scoreField' style='width:100%'>{!!Form::text('whites[]', null )!!}</td>
                @endforeach
                <td></td>
            </tr>
            <tr class='green'>
                <th style="text-align: right">PAR</th>
                @foreach( $frontHoleNums as $holeNum )
                    <td id='scoreField' style='width:100%'>{!!Form::text('pars[]', null )!!}</td>
                @endforeach
                <td></td>
            </tr>
            <tr class="white">
                <th style="text-align: right">SCORE</th>
                @foreach( $frontHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr class='grey'>
                <th style="text-align: right">GIR</td>
                @foreach( $frontHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr class="white">
                <th style="text-align: right">FAIRWAY</td>
                @foreach( $frontHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr class='grey'>
                <th style="text-align: right">PENALTY</td>
                @foreach( $frontHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr class='gold'>
                <th style="text-align: right">HANDICAP</td>
                    @foreach( $frontHoleNums as $holeNum )
                        <td id='scoreField' style='width:100%'>{!!Form::text('handicaps[]', null )!!}</td>
                    @endforeach
                <td></td>
            </tr>
        </table>
    </div>
    <div class='col-md-12'>
        <table id='golfcard' class='form-group'>
            <col span="1" class="wide">
            <tr class='blue'>
                <th style="text-align: right">HOLE</th>
                @foreach( $backHoleNums as $holeNum )
                    <td>{{$holeNum}}</td>
                    {!!Form::hidden( 'holeNumbers[]', $holeNum )!!}
                @endforeach
                <th>OUT</th>
            </tr>
            <tr class="white">
                <th style="text-align: right">WHITE TEES</th>
                @foreach( $backHoleNums as $holeNum )
                    <td id='scoreField' style='width:100%'>{!!Form::text( 'whites[]', null )!!}</td>
                @endforeach
                <td></td>
            </tr>
            <tr class='green'>
                <th style="text-align: right">PAR</th>
                @foreach($backHoleNums as $holeNum )
                    <td id='scoreField' style='width:100%'>{!!Form::text( 'pars[]', null )!!}</td>
                @endforeach
                <td></td>
            </tr>
            <tr class="white">
                <th style="text-align: right">SCORE</th>
                @foreach( $backHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr class='grey'>
                <th style="text-align: right">GIR</td>
                @foreach( $backHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr class="white">
                <th style="text-align: right">FAIRWAY</td>
                @foreach( $backHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr class='grey'>
                <th style="text-align: right">PENALTY</td>
                @foreach( $backHoleNums as $holeNum )
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr class='gold'>
                <th style="text-align: right">HANDICAP</td>
                    @foreach( $backHoleNums as $holeNum )
                        <td id='scoreField' style='width:100%'>{!!Form::text( 'handicaps[]', null )!!}</td>
                    @endforeach
                <td></td>
            </tr>
            <tr class='button-row'>
                <th colspan="11" style="text-align:right">
                    {!!Form::submit( 'Create', ['class'=>'btn btn-primary'] )!!}
                </th>
            </tr>
        </table>
    </div>
</div>
{!!Form::close()!!}
@endsection
