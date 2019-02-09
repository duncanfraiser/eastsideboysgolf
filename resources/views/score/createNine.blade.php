@extends('layouts.template')
@section('content')
{!!Form::open(['action' => 'ScoreController@store'])!!}
{!!Form::hidden('roundId', $round->id)!!}
<div class="flex-center position-ref full-height">
    <table id='golfcard' class='form-group'>
        <tr class='red'>
            <th colspan="11" class='courseName' style="text-align: left">
                {!!$scorecard->name!!}
            </th>
        </tr>
        <col span="1" class="wide">
        <tr class='blue'>
            <th style="text-align: right">HOLE</th>
            @foreach ( $scorecard->holes as $hole )
                <td>{!!$hole->hole_number!!}</td>
                {!!Form::hidden('holeNumbers[]', $hole->hole_number)!!}
            @endforeach
            <th>OUT</th>
        </tr>
        <tr class="white">
            <th style="text-align: right">WHITE TEES</th>
            @foreach ($scorecard->holes as $hole )
                <td id='scoreField'>{!!$hole->whites!!}</td>
            @endforeach
            <td>{!!$scorecard->holes->sum('whites')!!}</td>
        </tr>
        <tr class='green'>
            <th style="text-align: right">PAR</th>
            @foreach( $scorecard->holes as $hole )
                <td id='scoreField'>{!!$hole->par!!}</td>
            @endforeach
            <td>{!!$scorecard->holes->sum('par')!!}</td>
        </tr>
        <tr class="grey">
            <th style="text-align: right">SCORE</th>
            @foreach( $scorecard->holes as $hole )
                <td id='scoreField' style='width:100%'>{!!Form::text('scores[]', null )!!}</td>
            @endforeach
            <td></td>
        </tr>
        <tr class='grey'>
            <th style="text-align: right">GIR</td>
            @foreach( $scorecard->holes as $hole )
                <td>{!!Form::checkbox('GIRs[]', $hole->hole_number, false,['class' => 'checkcheky'])!!}</td>
            @endforeach
            <td></td>
        </tr>
        <tr class="grey">
            <th style="text-align: right">FAIRWAY</td>
            @foreach( $scorecard->holes as $hole )
                <td>{!!Form::checkbox('fairways[]', $hole->hole_number, false,['class' => 'checkcheky'])!!}</td>
            @endforeach
            <td></td>
        </tr>
        <tr class='grey'>
            <th style="text-align: right">PENALTY</td>
            @foreach( $scorecard->holes as $hole )
                <td>{!!Form::checkbox('penalties[]', $hole->hole_number, false,['class' => 'checkcheky'])!!}</td>
            @endforeach
            <td></td>
        </tr>
        <tr class='gold'>
            <th style="text-align: right">HANDICAP</td>
                @foreach ($scorecard->holes as $hole)
                    <td id='scoreField'>{!!$hole->handicap!!}</td>
                @endforeach
            <td>OUT</td>
        </tr>
        <tr class='button-row'>
            <th colspan="11" style="text-align:right">
                <a href={!! URL::previous() !!} class="btn btn-primary btn-sm">Back</a>
                {!!Form::submit( 'Create', ['class'=>'btn btn-primary'] )!!}
            </th>
        </tr>
    </table>
</div>
{!!Form::close()!!}
@endsection
