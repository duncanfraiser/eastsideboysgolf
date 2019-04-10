@extends('layouts.template')
@section('styles')
    input[type="checkbox"] {
      transform:scale(1.5, 1.5);
    }
@endsection
@section('content')
{!!Form::open(['action' => 'RoundController@store'])!!}
{!!Form::hidden('scorecardId', $scorecard->id)!!}
<div style="margin:5% 1%">
    <div>
        <table id='golfcard' class='form-group'>
            <tr class='red'>
                <th colspan="11" class='courseName' style="text-align: left">
                    {!!$scorecard->name!!}
                    <span style="font-size:14px">{!!$scorecard->slope_rating!!} / {!!$scorecard->course_rating!!}</span>
                    <a href={!!url('/scorecard/'.$scorecard->id.'/edit')!!} class="btn btn-danger btn-sm" style='float:right; margin:10px'>Edit Scorecard</a>
                </th>
            </tr>
            <col span="1" class="wide">
            <tr class='blue'>
                <th style="text-align: right">HOLE</th>
                @foreach ( $scorecard->holes as $hole )
                    @if($hole->hole_number<10)
                        <td>{!!$hole->hole_number!!}</td>
                    @endif
                    {!!Form::hidden('holeNumbers[]', $hole->hole_number)!!}
                @endforeach
                <th>OUT</th>
            </tr>
            <tr class="white">
                <th style="text-align: right">WHITE TEES</th>
                @foreach ($scorecard->holes as $hole )
                    @if($hole->hole_number<10)
                        <td id='scoreField'>{!!$hole->whites!!}</td>
                    @endif
                @endforeach
                <td>{!!$scorecard->holes->sum('whites')!!}</td>
            </tr>
            <tr class='green'>
                <th style="text-align: right">PAR</th>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number<10)
                        <td id='scoreField'>{!!$hole->par!!}</td>
                        {!!Form::hidden('pars[]', $hole->par)!!}
                    @endif
                @endforeach
                <td>{!!$scorecard->holes->sum('par')!!}</td>
            </tr>
            <tr class="grey">
                <th style="text-align: right">SCORE</th>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number<10)
                        <td id='scoreField' style='width:100%'><input type="text" name="scores[]" required></td>
                    @endif
                @endforeach
                <td></td>
            </tr>
            <tr class="grey">
                <th style="text-align: right">PUTT</th>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number<10)
                        <td id='scoreField' style='width:100%'><input type="text" name="putts[]" required></td>
                    @endif
                @endforeach
                <td></td>
            </tr>
            <tr class='grey'>
                <th style="text-align: right">GIR</td>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number<10)
                        <td>{!!Form::checkbox('GIRs[]', $hole->hole_number, false,['class' => 'checkcheky'])!!}</td>
                    @endif
                @endforeach
                <td></td>
            </tr>
            <tr class="grey">
                <th style="text-align: right">FAIRWAY</td>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number<10)
                        <td>{!!Form::select('fairways[]', ['0'=>'', '1' => 'L', '2' => 'R', '3'=>'C' ],null,['class'=>'form-control'])!!}</td>
                    @endif
                @endforeach
                <td></td>
            </tr>
            <tr class="grey">
                <th style="text-align: right">SAND</th>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number<10)
                        <td id='scoreField' style='width:100%'><input type="text" name="sands[]"></td>
                    @endif
                @endforeach
                <td></td>
            </tr>
            <tr class="grey">
                <th style="text-align: right">PENALTY</th>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number<10)
                        <td id='scoreField' style='width:100%'><input type="text" name="penalties[]"></td>
                    @endif
                @endforeach
                <td></td>
            </tr>
            <tr class='gold'>
                <th style="text-align: right">HANDICAP</td>
                    @foreach ($scorecard->holes as $hole)
                        @if($hole->hole_number<10)
                            <td id='scoreField'>{!!$hole->handicap!!}</td>
                        @endif
                    @endforeach
                <td>OUT</td>
            </tr>
        </table>
    </div>
    <div>
        <table id='golfcard' class='form-group'>
            <col span="1" class="wide">
            <tr class='blue'>
                <th style="text-align: right">HOLE</th>
                @foreach ( $scorecard->holes as $hole )
                    @if($hole->hole_number>9)
                        <td>{!!$hole->hole_number!!}</td>
                        {!!Form::hidden('holeNumbers[]', $hole->hole_number)!!}
                    @endif
                @endforeach
                <th>OUT</th>
            </tr>
            <tr class="white">
                <th style="text-align: right">WHITE TEES</th>
                @foreach ($scorecard->holes as $hole )
                    @if($hole->hole_number>9)
                        <td id='scoreField'>{!!$hole->whites!!}</td>
                    @endif
                @endforeach
                <td>{!!$scorecard->holes->sum('whites')!!}</td>
            </tr>
            <tr class='green'>
                <th style="text-align: right">PAR</th>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number>9)
                        <td id='scoreField'>{!!$hole->par!!}</td>
                        {!!Form::hidden('pars[]', $hole->par)!!}
                    @endif
                @endforeach
                <td>{!!$scorecard->holes->sum('par')!!}</td>
            </tr>
            <tr class="grey">
                <th style="text-align: right">SCORE</th>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number>9)
                        <td id='scoreField' style='width:100%'><input type="text" name="scores[]" required></td>
                    @endif
                @endforeach
                <td></td>
            </tr>
            <tr class="grey">
                <th style="text-align: right">PUTT</th>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number>9)
                        <td id='scoreField' style='width:100%'><input type="text" name="putts[]" required></td>
                    @endif
                @endforeach
                <td></td>
            </tr>
            <tr class='grey'>
                <th style="text-align: right">GIR</td>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number>9)
                        <td>{!!Form::checkbox('GIRs[]', $hole->hole_number, false,['class' => 'checkcheky'])!!}</td>
                    @endif
                @endforeach
                <td></td>
            </tr>
            <tr class="grey">
                <th style="text-align: right">FAIRWAY</td>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number>9)
                        <td>{!!Form::select('fairways[]', ['0'=>'', '1' => 'L', '2' => 'R', '3'=>'C' ],null,['class'=>'form-control'])!!}</td>
                    @endif
                @endforeach
                <td></td>
            </tr>
            <tr class="grey">
                <th style="text-align: right">SAND</th>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number>9)
                        <td id='scoreField' style='width:100%'><input type="text" name="sands[]"></td>
                    @endif
                @endforeach
                <td></td>
            </tr>
            <tr class="grey">
                <th style="text-align: right">PENALTY</th>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number>9)
                        <td id='scoreField' style='width:100%'><input type="text" name="penalties[]"></td>
                    @endif
                @endforeach
                <td></td>
            </tr>
            <tr class='gold'>
                <th style="text-align: right">HANDICAP</td>
                    @foreach ($scorecard->holes as $hole)
                        @if($hole->hole_number>9)
                            <td id='scoreField'>{!!$hole->handicap!!}</td>
                        @endif
                    @endforeach
                <td>OUT</td>
            </tr>
            <tr colspan="11">
                <td colspan="11" style="padding: 10px">
                    <span style="float:left">
                        {!!Form::radio('day', 'Monday', false)!!} Monday &nbsp;&nbsp;
                        {!!Form::radio('day', 'Wednesday', false)!!} Wednesday &nbsp;&nbsp;
                        {!!Form::radio('day', 'Friday', false)!!} Friday &nbsp;&nbsp;
                        {!!Form::radio('day', 'Outing', false)!!} Outing
                    </span>
                    {!!Form::submit( 'Submit', ['class'=>'btn btn-primary btn-sm', 'style'=>'float:right; margin:3px'] )!!}
                    <a href={!!url('/')!!} class="btn btn-secondary btn-sm" style='float:right; margin:3px'>Cancel</a>
                </td>
            </tr>

        </table>
    </div>
</div>
{!!Form::close()!!}
@endsection
