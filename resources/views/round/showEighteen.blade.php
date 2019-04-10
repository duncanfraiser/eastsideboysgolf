@extends('layouts.template')
@section('styles')
    input[type="checkbox"] {
      transform:scale(1.5, 1.5);
    }
@endsection
@section('content')
<div class="position-ref full-height">
    <div class='col-md-12'>
        <table id='golfcard' class='form-group'>
            <tr class='red'>
                <th colspan="11" class='courseName' style="text-align: left">{!!$scorecard->name!!}</th>
            </tr>
            <col span="1" class="wide">
            <tr class='blue'>
                <th style="text-align: right">HOLE</th>
                @foreach($frontNine as $hole)
                    <td>{!!$hole->hole_number!!}</td>
                @endforeach
                <th>OUT</th>
            </tr>
            <tr class="white">
                <th style="text-align: right">WHITE TEES</th>
                @foreach($frontNine as $hole)
                    <td id='scoreField'>{!!$hole->whites!!}</td>
                @endforeach
                <td>{!!$frontNine->sum('whites')!!}</td>
            </tr>
            <tr class='green'>
                <th style="text-align: right">PAR</th>
                @foreach($frontNine as $hole)
                    <td id='scoreField'>{!!$hole->par!!}</td>
                @endforeach
                <td>{!!$frontNine->sum('par')!!}</td>
            </tr>
            <tr class="grey">
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
                <td id='scoreField'>{!!$round->total_score!!}</td>
            </tr>
            <tr class='grey'>
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
                <td></td>
            </tr>
            <tr class="grey">
                <th style="text-align: right">FAIRWAY</th>
                @foreach( $round->scores as $score )
                    @if($score->hole_num < 10)
                        @if($score->fairway == 1)
                            <td><i style="color:blue" class="fas fa-check"></i></td>
                        @else
                            <td></td>
                        @endif
                    @endif
                @endforeach
                <td></td>
            </tr>
            <tr class='grey'>
                <th style="text-align: right">PENALTY</th>
                @foreach( $round->scores as $score )
                    @if($score->hole_num < 10)
                        @if($score->penalty == 1)
                            <td><i style="color:red" class="fas fa-check"></i></td>
                        @else
                            <td></td>
                        @endif
                    @endif
                @endforeach
                <td></td>
            </tr>
            <tr class='gold'>
                <td style="text-align: right">HANDICAP</td>
                    @foreach($frontNine as $hole)
                        <td id='scoreField'>{!!$hole->handicap!!}</td>
                    @endforeach
                <td>OUT</td>
            </tr>
        </table>
    </div>
    <div class="position-ref full-height">
        <div class='col-md-12'>
            <table id='golfcard' class='form-group'>
                <col span="1" class="wide">
                <tr class='blue'>
                    <th style="text-align: right">HOLE</th>
                    @foreach($backNine as $hole)
                        <td>{!!$hole->hole_number!!}</td>
                        {!!Form::hidden('holeNumbers[]', $hole->hole_number)!!}
                    @endforeach
                    <th>OUT</th>
                </tr>
                <tr class="white">
                    <th style="text-align: right">WHITE TEES</th>
                    @foreach($backNine as $hole)
                        <td id='scoreField'>{!!$hole->whites!!}</td>
                    @endforeach
                    <td></td>
                </tr>
                <tr class='green'>
                    <th style="text-align: right">PAR</th>
                    @foreach($backNine as $hole)
                        <td id='scoreField'>{!!$hole->par!!}</td>
                    @endforeach
                    <td>{!!$backNine->sum('par')!!}</td>
                </tr>
                <tr class="grey">
                    <th style="text-align: right">SCORE</th>
                    @foreach( $round->scores as $key=>$score )
                        @if($score->hole_num < 9)
                            @if($score->total > $scorecard->holes[$key]->par)
                                <td id='scoreField' style="color:red">{!!$score->total!!}</td>
                            @elseif($score->total < $scorecard->holes[$key]->par)
                                <td id='scoreField' style="color:blue">{!!$score->total!!}</td>
                            @elseif($score->total == $scorecard->holes[$key]->par)
                                <td id='scoreField' style="color:green">{!!$score->total!!}</td>
                            @endif
                        @endif
                    @endforeach
                    <td id='scoreField'>{!!$round->total_score!!}</td>
                </tr>
                <tr class='grey'>
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
                    <td></td>
                </tr>
                <tr class="grey">
                    <th style="text-align: right">FAIRWAY</th>
                    @foreach( $round->scores as $score )
                        @if($score->hole_num > 9)
                            @if($score->fairway == 1)
                                <td><i style="color:blue" class="fas fa-check"></i></td>
                            @else
                                <td></td>
                            @endif
                        @endif
                    @endforeach
                    <td></td>
                </tr>
                <tr class='grey'>
                    <th style="text-align: right">PENALTY</th>
                    @foreach( $round->scores as $score )
                        @if($score->hole_num > 9)
                            @if($score->penalty == 1)
                                <td><i style="color:red" class="fas fa-check"></i></td>
                            @else
                                <td></td>
                            @endif
                        @endif
                    @endforeach
                    <td></td>
                </tr>
                <tr class='gold'>
                    <th style="text-align: right">HANDICAP</td>
                        @foreach($backNine as $hole)
                            <td id='scoreField'>{!!$hole->handicap!!}</td>
                        @endforeach
                    <td>OUT</td>
                </tr>
                <tr class='button-row'>
                    <th colspan="11" style="text-align:right">
                        <a href={!!url('/round/'.$round->id.'/edit')!!} class="btn btn-danger btn-sm">Edit</a>
                        <a href={!!url('/')!!} class="btn btn-primary btn-sm">Home</a>
                    </th>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
