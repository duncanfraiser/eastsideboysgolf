@extends('layouts.template')
@section('content')
<div class="position-ref full-height" style="margin-top:3%">
    <div class='col-md-12 flex-center'>
        {!!Form::model($round, ['method' => 'PATCH', 'action' => ['RoundController@update', $round->id]])!!}
        <table id='golfcard' class='form-group'>
            <tr class='green-back cardHeader'>
                <th colspan="11" class='courseName' style="text-align: left">
                    {!!$scorecard->name!!}
                    <span style="font-size:14px">{!!$scorecard->slope_rating!!} / {!!$scorecard->course_rating!!}</span>
                    <p style="text-align:left;font-size:14px"><strong>Day Group:</strong>
                      <select name="day" class="greyColor" required>
                          @if($round->day != 'Monday')
                              <option value="Monday">Monday</option>
                          @else
                              <option selected="selected" value="Monday">Monday</option>
                          @endif
                          @if($round->day != 'Wednesday')
                              <option value="Wednesday">Wednesday</option>
                          @else
                              <option selected="selected" value="Wednesday">Wednesday</option>
                          @endif
                          @if($round->day != 'Friday')
                              <option value="Friday">Friday</option>
                          @else
                              <option selected="selected" value="Friday">Friday</option>
                          @endif
                          @if($round->day != 'Outing')
                              <option value="Outing">Outing</option>
                          @else
                              <option selected="selected" value="Outing">Outing</option>
                          @endif
                          @if($round->day != 'Play-To-Play')
                              <option value="Play-To-Play">Play-To-Play</option>
                          @else
                              <option selected="selected" value="Play-To-Play">Play-To-Play</option>
                          @endif
                      </select>
                      <span style="text-align:right">  &nbsp;&nbsp;&nbsp;&nbsp;<strong>Skins: </strong><input type="number" name="skins" value={!!$shot->skin!!} required></span>
                    </p>
                </th>
            </tr>
            <col span="1" class="wide">
            <tr class='blue-back'>
                <th style="text-align: right">HOLE</th>
                @foreach ( $scorecard->holes as $hole )
                    @if($hole->hole_number < 10)
                        <td>{!!$hole->hole_number!!}</td>
                    @endif
                @endforeach
                <td>OUT</td>
            </tr>
            <tr class='red-back'>
                <th style="text-align: right">PAR</th>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number < 10)
                        <td id='scoreField'>{!!$hole->par!!}</td>
                    @endif
                @endforeach
                <td>{!!$scorecard->getTotalFrontPars()!!}</td>
            </tr>
            <tr>
                <th style="text-align: right">SCORE</th>
                @foreach( $round->getFrontNineScores() as $score )
                    <td id='scoreField' style='width:100%'><input style="text-align:center" type="number" name="scores[]" value={!!$score->total!!} required></td>
                @endforeach
                <td id='scoreField'>{!!$round->getFrontNineTotalScore()!!}</td>
            </tr>
            <tr>
                <th style="text-align: right">PUTT</th>
                @foreach( $round->getFrontNineScores() as $score )
                        <td id='scoreField' style='width:100%'><input style="text-align:center" type="number" name="putts[]" value={!!$score->putt!!} required></td>
                @endforeach
                <td id='scoreField'>{!!$round->getFrontNineTotalScore()!!}</td>
            </tr>
            <tr>
                <th style="text-align: right">FAIRWAY</th>
                @foreach( $round->getFrontNineScores() as $score )
                        <td>{!!Form::select('fairways[]', ['0'=>'', '1' => 'L', '2' => 'R', '3'=>'C' ],$score->fairway,['class'=>'form-control',])!!}</td>
                @endforeach
                <td id='scoreField'>{!!$round->getFrontNineFairways()!!}</td>
            </tr>
            <tr>
                <th style="text-align: right">SAND</th>
                @foreach( $round->getFrontNineScores() as $score )
                    @if($score->sand > 0)
                        <td id='scoreField' style='width:100%'>{!!Form::number('sands[]',$score->sand,['style'=>'text-align:center'])!!}</td>
                    @else
                        <td id='scoreField' style='width:100%'>{!!Form::number('sands[]',null,['style'=>'text-align:center'])!!}</td>
                    @endif
                @endforeach
                <td id='scoreField'>{!!$round->getFrontNineSand()!!}</td>
            </tr>
            <tr>
                <th style="text-align: right">PENALTY</th>
                @foreach( $round->getFrontNineScores() as $score )
                    @if($score->penalty > 0)
                        <td id='scoreField' style='width:100%'>{!!Form::number('penalties[]',$score->penalty,['style'=>'text-align:center'])!!}</td>
                    @else
                        <td id='scoreField' style='width:100%'>{!!Form::number('penalties[]',null,['style'=>'text-align:center'])!!}</td>
                    @endif
                @endforeach
                <td id='scoreField'>{!!$round->getFrontNinePenalty()!!}</td>
            </tr>
        </table>
    </div>
    <div class='col-md-12'>
        <table id='golfcard' class='form-group'>
            <col span="1" class="wide">
            <tr class='blue-back'>
                <th style="text-align: right">HOLE</th>
                @foreach ( $scorecard->holes as $hole )
                    @if($hole->hole_number > 9)
                        <td>{!!$hole->hole_number!!}</td>
                    @endif
                @endforeach
                <td>IN</td>
            </tr>
            <tr class='green-back'>
                <th style="text-align: right">PAR</th>
                @foreach( $scorecard->holes as $hole )
                    @if($hole->hole_number > 9)
                        <td id='scoreField'>{!!$hole->par!!}</td>
                    @endif
                @endforeach
                <td>{!!$scorecard->getTotalBackPars()!!}</td>
            </tr>
            <tr>
                <th style="text-align: right">SCORE</th>
                @foreach( $round->getBackNineScores() as $key=>$score )
                    <td id='scoreField' style='width:100%'><input style="text-align:center" type="number" name="scores[]" value={!!$score->total!!} required></td>
                @endforeach
                <td id='scoreField'>{!!$round->getBackNineTotalScore()!!}</td>
            </tr>
            <tr>
                <th style="text-align: right">PUTT</th>
                @foreach( $round->getBackNineScores() as $score )
                        <td id='scoreField' style='width:100%'><input style="text-align:center" type="number" name="putts[]" value={!!$score->putt!!} required></td>
                @endforeach
                <td id='scoreField'>{!!$round->getBackNineTotalScore()!!}</td>
            </tr>


            <tr>
                <th style="text-align: right">FAIRWAY</th>
                @foreach( $round->getBackNineScores() as $score )
                        <td>{!!Form::select('fairways[]', ['0'=>'', '1' => 'L', '2' => 'R', '3'=>'C' ],$score->fairway,['class'=>'form-control',])!!}</td>
                @endforeach
                <td id='scoreField'>{!!$round->getBackNineFairways()!!}</td>
            </tr>
            <tr>
                <th style="text-align: right">SAND</th>
                @foreach( $round->getBackNineScores() as $score )
                    @if($score->sand > 0)
                        <td id='scoreField' style='width:100%'>{!!Form::number('sands[]',$score->sand,['style'=>'text-align:center'])!!}</td>
                    @else
                        <td id='scoreField' style='width:100%'>{!!Form::number('sands[]',null,['style'=>'text-align:center'])!!}</td>
                    @endif
                @endforeach
                <td id='scoreField'>{!!$round->getFrontNineSand()!!}</td>
            </tr>
            <tr>
                <th style="text-align: right">PENALTY</th>
                @foreach( $round->getBackNineScores() as $score )
                    @if($score->penalty > 0)
                        <td id='scoreField' style='width:100%'>{!!Form::number('penalties[]',$score->penalty,['style'=>'text-align:center'])!!}</td>
                    @else
                        <td id='scoreField' style='width:100%'>{!!Form::number('penalties[]',null,['style'=>'text-align:center'])!!}</td>
                    @endif
                @endforeach
                <td id='scoreField'>{!!$round->getBackNinePenalty()!!}</td>
            </tr>
            <tr class='button-row'>
                <td colspan="11" style="text-align:right;padding: 15px">
                    <a href={!!url('/round')!!} class="btn btn-success btn-sm">Cancel</a>
                    <a href={!!url('/')!!} class="btn btn-success btn-sm">Home</a>
                    {!!Form::submit('Update', ['class'=>'btn btn-success btn-sm'])!!}
                </td>
            </tr>
        </table>
        {!!Form::close()!!}
    </div>
</div>
@endsection
