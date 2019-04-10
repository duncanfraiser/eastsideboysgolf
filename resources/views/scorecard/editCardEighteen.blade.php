@extends('layouts.template')
@section('content')
<div>
    <div style="margin:5% 1%">
        {!!Form::model($scorecard, ['method' => 'PATCH', 'action' => ['ScorecardController@update', $scorecard->id]])!!}
        <table id='golfcard' class='form-group'>
            <tr class='red'>
                <th colspan="11" style="text-align: left">
                    {!!Form::text('name',null, ['style'=>'font-size:25px;margin:10px', 'placeholder' => 'Course Name'])!!}
                    {!!Form::text('course_rating',null, ['style'=>'margin:10px', 'placeholder' => 'Course Rating'])!!}
                    {!!Form::text('slope_rating',null, ['style'=>'margin:10px', 'placeholder' => 'Slope Rating'])!!}
                </th>
            </tr>
            <col span="1" class="wide">
            <tr class='blue'>
                <th style="text-align: right">HOLE</th>
                    @foreach ($scorecard->holes as $hole)
                        @if($hole->hole_number<10)
                            <td id='scoreField' style='width:100%'>{!!Form::text('updatedHoles[]',$hole->hole_number)!!}</td>
                        @endif
                    @endforeach
                <th>OUT</th>
            </tr>
            <tr class="white">
                <th style="text-align: right">WHITE TEES</th>
                @foreach ($scorecard->holes as $hole )
                    @if($hole->hole_number<10)
                        <td id='scoreField' style='width:100%'>{!!Form::text('updatedWhites[]',$hole->whites)!!}</td>
                    @endif
                @endforeach
                <td>{!!$scorecard->holes->sum('whites')!!}</td>
            </tr>
            <tr class='green'>
                <th style="text-align: right">PAR</th>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number<10)
                        <td id='scoreField' style='width:100%'>{!!Form::text('updatedPars[]',$hole->par)!!}</td>
                    @endif
                @endforeach
                <td>{!!$scorecard->holes->sum('par')!!}</td>
            </tr>
            <tr class="grey">
                <th style="text-align: right">SCORE</th>
                @for ($i=0; $i < 10; $i++)
                    <td></td>
                @endfor
            </tr>
            <tr class="grey">
                <th style="text-align: right">PUTT</th>
                @for ($i=0; $i < 10; $i++)
                    <td></td>
                @endfor
            </tr>
            <tr class='grey'>
                <th style="text-align: right">GIR</th>
                @for ($i=0; $i < 10; $i++)
                    <td></td>
                @endfor
            </tr>
            <tr class="grey">
                <th style="text-align: right">FAIRWAY</th>
                @for ($i=0; $i < 10; $i++)
                    <td></td>
                @endfor
            </tr>
            <tr class='grey'>
                <th style="text-align: right">SAND</th>
                @for ($i=0; $i < 10; $i++)
                    <td></td>
                @endfor
            </tr>
            <tr class='grey'>
                <th style="text-align: right">PENALTY</th>
                @for ($i=0; $i < 10; $i++)
                    <td></td>
                @endfor
            </tr>
            <tr class='gold'>
                <th style="text-align: right">HANDICAP</th>
                    @foreach ($scorecard->holes as $hole)
                        @if($hole->hole_number<10)
                            <td id='scoreField' style='width:100%'>{!!Form::text('updatedHandicaps[]',$hole->handicap)!!}</td>
                        @endif
                    @endforeach
                <td>OUT</td>
            </tr>
        </table>
        <table id='golfcard' class='form-group'>
            <col span="1" class="wide">
            <tr class='blue'>
                <th style="text-align: right">HOLE</th>
                    @foreach ($scorecard->holes as $hole)
                        @if($hole->hole_number>9)
                            <td id='scoreField'>{!!Form::text('updatedHoles[]',$hole->hole_number)!!}</td>
                        @endif
                    @endforeach
                <th>OUT</th>
            </tr>
            <tr class="white">
                <th style="text-align: right">WHITE TEES</th>
                @foreach ($scorecard->holes as $hole )
                    @if($hole->hole_number>9)
                        <td id='scoreField'>{!!Form::text('updatedWhites[]',$hole->whites)!!}</td>
                    @endif
                @endforeach
                <td>{!!$scorecard->holes->sum('whites')!!}</td>
            </tr>
            <tr class='green'>
                <th style="text-align: right">PAR</th>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number>9)
                        <td id='scoreField'>{!!Form::text('updatedPars[]',$hole->par)!!}</td>
                    @endif
                @endforeach
                <td>{!!$scorecard->holes->sum('par')!!}</td>
            </tr>
            <tr class="grey">
                <th style="text-align: right">SCORE</th>
                @for ($i=0; $i < 10; $i++)
                    <td></td>
                @endfor
            </tr>
            <tr class='grey'>
                <th style="text-align: right">PUTT</th>
                @for ($i=0; $i < 10; $i++)
                    <td></td>
                @endfor
            </tr>
            <tr class='grey'>
                <th style="text-align: right">GIR</th>
                @for ($i=0; $i < 10; $i++)
                    <td></td>
                @endfor
            </tr>
            <tr class="grey">
                <th style="text-align: right">FAIRWAY</th>
                @for ($i=0; $i < 10; $i++)
                    <td></td>
                @endfor
            </tr>
            <tr class='grey'>
                <th style="text-align: right">SAND</th>
                @for ($i=0; $i < 10; $i++)
                    <td></td>
                @endfor
            </tr>
            <tr class='grey'>
                <th style="text-align: right">PENALTY</th>
                @for ($i=0; $i < 10; $i++)
                    <td></td>
                @endfor
            </tr>
            <tr class='gold'>
                <th style="text-align: right">HANDICAP</th>
                    @foreach ($scorecard->holes as $hole)
                        @if($hole->hole_number>9)
                            <td id='scoreField'>{!!Form::text('updatedHandicaps[]',$hole->handicap)!!}</td>
                        @endif
                    @endforeach
                <td>OUT</td>
            </tr>
            <tr colspan="11">
                <td colspan="11" style="padding: 10px">
                    {!!Form::submit( 'Update', ['class'=>'btn btn-primary btn-sm', 'style'=>'float:right; margin:3px'] )!!}
                    <a href={!!url('/')!!} class="btn btn-secondary btn-sm" style='float:right; margin:3px'>Cancel</a>
                    {!!Form::close()!!}
                    {!!Form::open(['method' => 'DELETE', 'route' => ['scorecard.destroy', $scorecard->id]])!!}
                        {!!Form::submit('Delete', ['class' => 'btn-sm btn-danger', 'style'=>'float:right; margin:3px'])!!}
                    {!!Form::close()!!}
                </td>
            </tr>
        </table>

    </div>
</div>

@endsection
