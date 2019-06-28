@extends('layouts.template')
@section('content')

<div style="margin:10% 1%">
    {!!Form::model($scorecard, ['method' => 'PATCH', 'action' => ['ScorecardController@update', $scorecard->id]])!!}
    <table id='golfcard' class='form-group'>
        <tr class='green-back cardHeader'>
            <td colspan="11" style="text-align: left">
                {!!Form::text('name',null, ['style'=>'font-size:25px;margin:10px', 'placeholder' => 'Course Name'])!!}
                {!!Form::number('course_rating',null, ['style'=>'margin:10px', 'placeholder' => 'Course Rating'])!!}
                {!!Form::number('slope_rating',null, ['style'=>'margin:10px', 'placeholder' => 'Slope Rating'])!!}
            </td>
        </tr>
        <col span="1" class="wide">
        <tr class='blue-back'>
            <th style="text-align: right">HOLE</th>
                @foreach ($scorecard->holes as $hole)
                    <td>{!!$hole->hole_number!!}</td>
                @endforeach
            <th>OUT</th>
        </tr>
        <tr class='red-back'>
            <th style="text-align: right">PAR</th>
            @foreach( $scorecard->holes as $hole )
                <td id='scoreField' style='width:100%'>{!!Form::number('updatedPars[]',$hole->par)!!}</td>
            @endforeach
            <td>{!!$scorecard->holes->sum('par')!!}</td>
        </tr>
        <tr>
            <th style="text-align: right">SCORE</th>
            @for ($i=0; $i < 10; $i++)
                <td></td>
            @endfor
        </tr>
        <tr>
            <th style="text-align: right">PUTT</th>
            @for ($i=0; $i < 10; $i++)
                <td></td>
            @endfor
        </tr>
        <tr>
            <th style="text-align: right">FAIRWAY</th>
            @for ($i=0; $i < 10; $i++)
                <td></td>
            @endfor
        </tr>
        <tr>
            <th style="text-align: right">SAND</th>
            @for ($i=0; $i < 10; $i++)
                <td></td>
            @endfor
        </tr>
        <tr>
            <th style="text-align: right">PENALTY</th>
            @for ($i=0; $i < 10; $i++)
                <td></td>
            @endfor
        </tr>
        <tr class='button-row green-back'>
            <th colspan="11" style="padding: 10px">
                {!!Form::submit( 'Update', ['class'=>'btn btn-primary btn-sm', 'style'=>'float:right; margin:3px'] )!!}
                {!!Form::close()!!}
                {!!Form::open(['method' => 'DELETE', 'route' => ['scorecard.destroy', $scorecard->id], 'id' => 'deleter'])!!}
                    {!!Form::submit('Delete', ['class' => 'btn-sm btn-primary', 'style'=>'float:right; margin:3px'])!!}
                <a href={!!url('/')!!} class="btn btn-primary btn-sm" style='float:right; margin:3px'>Cancel</a>
                {!!Form::close()!!}
            </th>
        </tr>
    </table>
</div>
@endsection
@section('scripts')
        $("#deleter").on("submit", function(){
            return confirm("Are you sure you want to delete {{$scorecard->name}} from the scorcards?");
        });
@endsection
