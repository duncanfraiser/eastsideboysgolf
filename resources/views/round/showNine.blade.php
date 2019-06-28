@extends('layouts.template')
@section('content')
    <div class="flex-center position-ref full-height">
        <div class='col-md-12 flex-center'>
            <table id='golfcard' class='form-group'>
                <tr class='green-back cardHeader'>
                    <th colspan="11" class='courseName' style="text-align: left">
                        {!!$scorecard->name!!}
                        <span style="font-size:14px">{!!$scorecard->slope_rating!!} / {!!$scorecard->course_rating!!}</span>
                        <span style="font-size:16px; float:right">{!!$round->day!!} Group</br>Skins: {!!$shot->skin!!}</span>
                    </th>
                </tr>
                <col span="1" class="wide">
                <tr class='blue-back'>
                    <th style="text-align: right">HOLE</th>
                    @foreach($scorecard->getFrontNineHoles() as $hole)
                        <td>{!!$hole->hole_number!!}</td>
                        {!!Form::hidden('holeNumbers[]', $hole->hole_number)!!}
                    @endforeach
                    <td>TOTAL</td>
                </tr>
                <tr class='red-back'>
                    <th style="text-align: right">PAR</th>
                    @foreach($scorecard->getFrontNineHoles() as $hole)
                        <td id='scoreField'>{!!$hole->par!!}</td>
                    @endforeach
                    <td>{!!$scorecard->getTotalPars()!!}</td>
                </tr>
                <tr>
                    <th style="text-align: right">SCORE</th>
                    @foreach( $round->getFrontNineScores() as $key=>$score )
                            @if($score->total > $scorecard->holes[$key]->par)
                                <td id='scoreField' style="color:red">{!!$score->total!!}</td>
                            @elseif($score->total < $scorecard->holes[$key]->par)
                                <td id='scoreField' style="color:blue">{!!$score->total!!}</td>
                            @elseif($score->total == $scorecard->holes[$key]->par)
                                <td id='scoreField' style="color:green">{!!$score->total!!}</td>
                            @endif
                    @endforeach
                    <td id='scoreField'>{!!$round->getRoundScore()!!}</td>
                </tr>
                <tr>
                    <th style="text-align: right">PUTT</th>
                    @foreach( $round->getFrontNineScores() as $key=>$score )
                        @if($score->putt > 2)
                            <td id='scoreField' style="color:red">{!!$score->putt!!}</td>
                        @elseif($score->putt == 2)
                            <td id='scoreField' style="color:blue">{!!$score->putt!!}</td>
                        @elseif($score->putt < 2)
                            <td id='scoreField' style="color:green">{!!$score->putt!!}</td>
                        @endif
                    @endforeach
                    <td>{!!$round->getRoundPutts()!!}</td>
                </tr>
                <tr>
                    <th style="text-align: right">GIR</th>
                    @foreach( $round->getFrontNineScores() as $key=>$score )
                        @if($score->gir == 1)
                            <td><i style="color:green" class="fas fa-check"></i></td>
                        @else
                            <td></td>
                        @endif
                    @endforeach
                    <td>{!!$round->getRoundGIR()!!}</td>
                </tr>
                <tr>
                    <th style="text-align: right">FAIRWAY</th>
                    @foreach( $round->getFrontNineScores() as $key=>$score )
                        @if($score->fairway == 1)
                            <td id='scoreField'>L</td>
                        @elseif($score->fairway == 2)
                            <td id='scoreField'>R</td>
                        @elseif($score->fairway == 3)
                            <td id='scoreField'>C</td>
                        @else
                            <td id='scoreField'></td>
                        @endif
                    @endforeach
                    <td>{!!$round->getRoundFairways()!!}</td>
                </tr>
                <tr>
                    <th style="text-align: right">SAND</th>
                    @foreach( $round->getFrontNineScores() as $key=>$score )
                        @if($score->sand > 0)
                            <td id='scoreField' style="color:red">{!!$score->sand!!}</td>
                        @else
                            <td></td>
                        @endif
                    @endforeach
                    <td>{!!$round->getRoundSand()!!}</td>
                </tr>
                <tr>
                    <th style="text-align: right">PENALTY</th>
                    @foreach( $round->getFrontNineScores() as $key=>$score )
                        @if($score->penalty > 0)
                            <td id='scoreField' style="color:red">{!!$score->penalty!!}</td>
                        @else
                            <td></td>
                        @endif
                    @endforeach
                    <td>{!!$round->getRoundPenalty()!!}</td>
                </tr>
                <tr class='button-row green-back'>
                    <th colspan="11" style="text-align:right">
                        {!!Form::open(['method' => 'DELETE', 'route' => ['round.destroy', $round->id]])!!}
                            {!!Form::submit('Delete', ['class' => 'btn-sm btn-danger', 'style'=>'float:right; margin-left:3px'])!!}
                        {!!Form::close()!!}
                        <a href={!!URL::previous()!!} class="btn btn-primary btn-sm">Back</a>
                        <a href={!!url('/round/'.$round->id.'/edit')!!} class="btn btn-primary btn-sm">Edit</a>
                        <a href={!!url('/')!!} class="btn btn-primary btn-sm">Home</a>
                    </th>
                </tr>
            </table>
        </div>
    </div>

@endsection
