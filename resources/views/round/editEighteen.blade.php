@extends('layouts.template')
@section('styles')
    input[type="checkbox"] {
      transform:scale(1.5, 1.5);
    }
@endsection
@section('content')
<div class="flex-center position-ref full-height">
    {!!Form::model($round, ['method' => 'PATCH', 'action' => ['RoundController@update', $round->id]])!!}
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
                @if($hole->hole_number < 10)
                    <td>{!!$hole->hole_number!!}</td>
                @endif
            @endforeach
            <th>OUT</th>
        </tr>
        <tr class="white">
            <th style="text-align: right">WHITE TEES</th>
            @foreach ($scorecard->holes as $hole )
                @if($hole->hole_number < 10)
                    <td id='scoreField'>{!!$hole->whites!!}</td>
                @endif
            @endforeach
            <td>{!!$scorecard->holes->sum('whites')!!}</td>
        </tr>
        <tr class='green'>
            <th style="text-align: right">PAR</th>
            @foreach( $scorecard->holes as $hole )
                @if($hole->hole_number < 10)
                    <td id='scoreField'>{!!$hole->par!!}</td>
                @endif
            @endforeach
            <td>{!!$scorecard->holes->sum('par')!!}</td>
        </tr>
        <tr class="grey">
            <th style="text-align: right">SCORE</th>
            @foreach( $round->scores as $key=>$score )
                @if($score->hole_num < 10)
                    <td id='scoreField' style='width:100%'>{!!Form::text('updatedScores[]',$score->total)!!}</td>
                @endif
            @endforeach
            <td id='scoreField'>{!!$round->total_score!!}</td>
        </tr>
        <tr class='grey'>
            <th style="text-align: right">GIR</td>
            @foreach( $round->scores as $key=>$score )
                @if($score->hole_num < 10)
                    @if($score->gir != 1)
                        <td>{!!Form::checkbox('updatedGIRs[]', $score->hole_num, false,['class'=>'checkcheky'])!!}</td>
                    @else
                        <td>{!!Form::checkbox('updatedGIRs[]', $score->hole_num, true,['class'=>'checkcheky'])!!}</td>
                    @endif
                @endif
            @endforeach
            <td></td>
        </tr>

        <tr class='grey'>
            <th style="text-align: right">FAIRWAY</td>
            @foreach( $round->scores as $key=>$score )
                @if($score->hole_num < 10)
                    @if($score->fairway != 1)
                        <td>{!!Form::checkbox('updatedFairways[]', $score->hole_num, false,['class' => 'checkcheky'])!!}</td>
                    @else
                        <td>{!!Form::checkbox('updatedFairways[]', $score->hole_num, true,['class' => 'checkcheky'])!!}</td>
                    @endif
                @endif
            @endforeach
            <td></td>
        </tr>

        <tr class='grey'>
            <th style="text-align: right">PENALTY</td>
            @foreach($round->scores as $key=>$score)
                @if($score->hole_num < 10)
                    @if($score->penalty != 1)
                        <td>{!!Form::checkbox('updatedPenalties[]', $score->hole_num, false,['class' => 'checkcheky'])!!}</td>
                    @else
                        <td>{!!Form::checkbox('updatedPenalties[]', $score->hole_num, true,['class' => 'checkcheky'])!!}</td>
                    @endif
                @endif
            @endforeach
            <td></td>
        </tr>
        <tr class='gold'>
            <th style="text-align: right">HANDICAP</th>
                @foreach($scorecard->holes as $hole)
                    @if($hole->hole_number < 10)
                        <td id='scoreField'>{!!$hole->handicap!!}</td>
                    @endif
                @endforeach
            <td>OUT</td>
        </tr>
    </table>
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
                @if($hole->hole_number > 9)
                    <td>{!!$hole->hole_number!!}</td>
                @endif
            @endforeach
            <th>OUT</th>
        </tr>
        <tr class="white">
            <th style="text-align: right">WHITE TEES</th>
            @foreach ($scorecard->holes as $hole )
                @if($hole->hole_number > 9)
                    <td id='scoreField'>{!!$hole->whites!!}</td>
                @endif
            @endforeach
            <td>{!!$scorecard->holes->sum('whites')!!}</td>
        </tr>
        <tr class='green'>
            <th style="text-align: right">PAR</th>
            @foreach( $scorecard->holes as $hole )
                @if($hole->hole_number > 9)
                    <td id='scoreField'>{!!$hole->par!!}</td>
                @endif
            @endforeach
            <td>{!!$scorecard->holes->sum('par')!!}</td>
        </tr>
        <tr class="grey">
            <th style="text-align: right">SCORE</th>
            @foreach( $round->scores as $key=>$score )
                @if($score->hole_num > 9)
                    <td id='scoreField' style='width:100%'>{!!Form::text('updatedScores[]', $score->total )!!}</td>
                @endif
            @endforeach
            <td id='scoreField'>{!!$round->total_score!!}</td>
        </tr>

        <tr class='grey'>
            <th style="text-align: right">GIR</td>
            @foreach( $round->scores as $key=>$score )
                @if($score->hole_num > 9)
                    @if($score->gir != 1)
                        <td>{!!Form::checkbox('updatedGIRs[]', $score->hole_num, false,['class' => 'checkcheky'])!!}</td>
                    @else
                        <td>{!!Form::checkbox('updatedGIRs[]', $score->hole_num, true,['class' => 'checkcheky'])!!}</td>
                    @endif
                @endif
            @endforeach
            <td></td>
        </tr>

        <tr class='grey'>
            <th style="text-align: right">FAIRWAY</td>
            @foreach( $round->scores as $key=>$score )
                @if($score->hole_num > 9)
                    @if($score->fairway != 1)
                        <td>{!!Form::checkbox('updatedFairways[]', $score->hole_num, false,['class' => 'checkcheky'])!!}</td>
                    @else
                        <td>{!!Form::checkbox('updatedFairways[]', $score->hole_num, true,['class' => 'checkcheky'])!!}</td>
                    @endif
                @endif
            @endforeach
            <td></td>
        </tr>

        <tr class='grey'>
            <th style="text-align: right">PENALTY</td>
            @foreach($round->scores as $key=>$score)
                @if($score->hole_num > 9)
                    @if($score->penalty != 1)
                        <td>{!!Form::checkbox('updatedPenalties[]', $score->hole_num, false,['class' => 'checkcheky'])!!}</td>
                    @else
                        <td>{!!Form::checkbox('updatedPenalties[]', $score->hole_num, true,['class' => 'checkcheky'])!!}</td>
                    @endif
                @endif
            @endforeach
            <td></td>
        </tr>
        <tr class='gold'>
            <th style="text-align: right">HANDICAP</th>
                @foreach($scorecard->holes as $hole)
                    @if($hole->hole_number > 9)
                        <td id='scoreField'>{!!$hole->handicap!!}</td>
                    @endif
                @endforeach
            <td>OUT</td>
        </tr>
        <tr class='button-row'>
            <th colspan="11" style="text-align:right">
                <a href={!!URL::previous()!!} class="btn btn-primary btn-sm">Back</a>
                {!!Form::submit('Update', ['class'=>'btn btn-success btn-sm'])!!}
            </th>
        </tr>
    </table>
    {!!Form::close()!!}
</div>
@endsection
