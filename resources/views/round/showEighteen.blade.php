@extends('layouts.template')
@section('content')
<div class="position-ref full-height" style="margin-top:3%">
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
                @foreach($frontNine as $hole)
                    <td>{!!$hole->hole_number!!}</td>
                @endforeach
                <td>OUT</td>
            </tr>
            <tr class='red-back'>
                <th style="text-align: right">PAR</th>
                @foreach($frontNine as $hole)
                    <td id='scoreField'>{!!$hole->par!!}</td>
                @endforeach
                <td>{!!$scorecard->getTotalFrontPars()!!}</td>
            </tr>
            <tr>
                <th style="text-align: right">SCORE</th>
                @foreach( $round->scores as $key=>$score )
                    @if($score->hole_num < 10)
                        @if($score->total > $scorecard->holes[$key]->par)
                            <td id='scoreField' style="color:red">{!!$score->total!!}</td>
                        @elseif($score->total < $scorecard->holes[$key]->par)
                            <td id='scoreField' style="color:blue">{!!$score->total!!}</td>
                        @elseif($score->total == $scorecard->holes[$key]->par)
                            <td id='scoreField' style="color:green">{!!$score->total!!}</td>
                        @endif
                    @endif
                @endforeach
                <td id='scoreField'>{!!$round->getFrontNineTotalScore()!!}</td>
            </tr>
            <tr>
                <th style="text-align: right">PUTT</th>
                @foreach( $round->scores as $key=>$score )
                    @if($score->hole_num < 10)
                        @if($score->putt > 2)
                            <td id='scoreField' style="color:red">{!!$score->putt!!}</td>
                        @elseif($score->putt == 2)
                            <td id='scoreField' style="color:blue">{!!$score->putt!!}</td>
                        @elseif($score->putt < 2)
                            <td id='scoreField' style="color:green">{!!$score->putt!!}</td>
                        @endif
                    @endif
                @endforeach
                <td>{!!$round->getFrontNinePutts()!!}</td>
            </tr>
            <tr>
                <th style="text-align: right">GIR</th>
                @foreach( $round->scores as $score )
                    @if($score->hole_num < 10)
                        @if($score->gir == 1)
                            <td><i style="color:green" class="fas fa-check"></i></td>
                        @else
                            <td></td>
                        @endif
                    @endif
                @endforeach
                <td>{!!$round->getFrontNineGIR()!!}</td>
            </tr>
            <tr>
                <th style="text-align: right">FAIRWAY</th>
                @foreach( $round->scores as $score )
                    @if($score->hole_num < 10)
                        @if($score->fairway == 1)
                            <td id='scoreField'>L</td>
                        @elseif($score->fairway == 2)
                            <td id='scoreField'>R</td>
                        @elseif($score->fairway == 3)
                            <td id='scoreField'>C</td>
                        @else
                            <td id='scoreField'></td>
                        @endif
                    @endif
                @endforeach
                <td>{!!$round->getFrontNineFairways()!!}</td>
            </tr>
            <tr>
                <th style="text-align: right">SAND</th>
                @foreach( $round->scores as $score )
                    @if($score->hole_num < 10)
                        @if($score->sand > 0)
                            <td id='scoreField' style="color:red">{!!$score->sand!!}</td>
                        @else
                            <td></td>
                        @endif
                    @endif
                @endforeach
                <td>{!!$round->getFrontNineSand()!!}</td>
            </tr>
            <tr>
                <th style="text-align: right">PENALTY</th>
                @foreach( $round->scores as $score )
                    @if($score->hole_num < 10)
                        @if($score->penalty > 0)
                            <td id='scoreField' style="color:red">{!!$score->penalty!!}</td>
                        @else
                            <td></td>
                        @endif
                    @endif
                @endforeach
                <td>{!!$round->getFrontNinePenalty()!!}</td>
            </tr>
        </table>
    </div>
    <div class="position-ref full-height">
        <div class='col-md-12'>
            <table id='golfcard' class='form-group'>
                <col span="1" class="wide">
                <tr class='blue-back'>
                    <th style="text-align: right">HOLE</th>
                    @foreach($backNine as $hole)
                        <td>{!!$hole->hole_number!!}</td>
                        {!!Form::hidden('holeNumbers[]', $hole->hole_number)!!}
                    @endforeach
                    <td>IN</td>
                    <td>TOTAL</td>
                </tr>
                <tr class='red-back'>
                    <th style="text-align: right">PAR</th>
                    @foreach($backNine as $hole)
                        <td id='scoreField'>{!!$hole->par!!}</td>
                    @endforeach
                    <td>{!!$scorecard->getTotalBackPars()!!}</td>
                    <td>{!!$scorecard->getTotalPars()!!}</td>
                </tr>
                <tr>
                    <th style="text-align: right">SCORE</th>
                    @foreach( $round->scores as $key=>$score )
                        @if($score->hole_num > 9)
                            @if($score->total > $scorecard->holes[$key]->par)
                                <td id='scoreField' style="color:red">{!!$score->total!!}</td>
                            @elseif($score->total < $scorecard->holes[$key]->par)
                                <td id='scoreField' style="color:blue">{!!$score->total!!}</td>
                            @elseif($score->total == $scorecard->holes[$key]->par)
                                <td id='scoreField' style="color:green">{!!$score->total!!}</td>
                            @endif
                        @endif
                    @endforeach
                    <td id='scoreField'>{!!$round->getBackNineTotalScore()!!}</td>
                    <td id='scoreField'>{!!$round->getRoundScore()!!}</td>
                </tr>
                <tr>
                    <th style="text-align: right">PUTT</th>
                    @foreach( $round->scores as $key=>$score )
                        @if($score->hole_num > 9)
                            @if($score->putt > 2)
                                <td id='scoreField' style="color:red">{!!$score->putt!!}</td>
                            @elseif($score->putt == 2)
                                <td id='scoreField' style="color:blue">{!!$score->putt!!}</td>
                            @elseif($score->putt < 2)
                                <td id='scoreField' style="color:green">{!!$score->putt!!}</td>
                            @endif
                        @endif
                    @endforeach
                    <td>{!!$round->getBackNinePutts()!!}</td>
                    <td>{!!$round->getRoundPutts()!!}</td>
                </tr>
                <tr>
                    <th style="text-align: right">GIR</th>
                    @foreach( $round->scores as $score )
                        @if($score->hole_num > 9)
                            @if($score->gir == 1)
                                <td><i style="color:green" class="fas fa-check"></i></td>
                            @else
                                <td></td>
                            @endif
                        @endif
                    @endforeach
                    <td>{!!$round->getBackNineGIR()!!}</td>
                    <td>{!!$round->getRoundGIR()!!}</td>
                </tr>
                <tr>
                    <th style="text-align: right">FAIRWAY</th>
                    @foreach( $round->scores as $score )
                        @if($score->hole_num > 9)
                            @if($score->fairway == 1)
                                <td id='scoreField'>L</td>
                            @elseif($score->fairway == 2)
                                <td id='scoreField'>R</td>
                            @elseif($score->fairway == 3)
                                <td id='scoreField'>C</td>
                            @else
                                <td id='scoreField'></td>
                            @endif
                        @endif
                    @endforeach
                    <td>{!!$round->getBackNineFairways()!!}</td>
                    <td>{!!$round->getRoundFairways()!!}</td>
                </tr>
                <tr>
                    <th style="text-align: right">SAND</th>
                    @foreach( $round->scores as $score )
                        @if($score->hole_num > 9)
                            @if($score->sand > 0)
                                <td id='scoreField' style="color:red">{!!$score->sand!!}</td>
                            @else
                                <td></td>
                            @endif
                        @endif
                    @endforeach
                    <td>{!!$round->getBackNineSand()!!}</td>
                    <td>{!!$round->getRoundSand()!!}</td>
                </tr>
                <tr>
                    <th style="text-align: right">PENALTY</th>
                    @foreach( $round->scores as $score )
                        @if($score->hole_num > 9)
                            @if($score->penalty > 0)
                                <td id='scoreField' style="color:red">{!!$score->penalty!!}</td>
                            @else
                                <td></td>
                            @endif
                        @endif
                    @endforeach
                    <td>{!!$round->getBackNinePenalty()!!}</td>
                    <td>{!!$round->getRoundPenalty()!!}</td>
                </tr>
                <tr class='button-row green-back'>
                    <th colspan="12" >
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
</div>
@endsection
