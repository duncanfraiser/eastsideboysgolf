{{-- @extends('layouts.template')
@section('styles')
    input[type="checkbox"] {
      transform:scale(1.5, 1.5);
    }
@endsection
@section('content')
{!!Form::open(['action' => 'RoundController@store'])!!}
{!!Form::hidden('scorecardId', $scorecard->id)!!}
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
                    {!!Form::hidden('holeNumbers[]', $hole->hole_number)!!}
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
                @foreach($frontNine as $hole)
                    <td id='scoreField' style='width:100%'><input type="text" name="scores[]" required></td>
                @endforeach
                <td></td>
            </tr>
            <tr class='grey'>
                <th style="text-align: right">GIR</td>
                @foreach( $frontNine as $hole )
                    <td>{!!Form::checkbox('GIRs[]', $hole->hole_number, false,['class' => 'checkcheky'])!!}</td>
                @endforeach
                <td></td>
            </tr>
            <tr class="white">
                <th style="text-align: right">FAIRWAY</td>
                @foreach( $frontNine as $hole )
                    <td>{!!Form::checkbox('fairways[]', $hole->hole_number, false,['class' => 'checkcheky'])!!}</td>
                @endforeach
                <td></td>
            </tr>
            <tr class='grey'>
                <th style="text-align: right">PENALTY</td>
                @foreach( $frontNine as $hole )
                    <td>{!!Form::checkbox('penalties[]', $hole->hole_number, false,['class' => 'checkcheky'])!!}</td>
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
                    @foreach($backNine as $hole)
                        <td id='scoreField' style='width:100%'><input type="text" name="scores[]" required></td>
                    @endforeach
                    <td></td>
                </tr>
                <tr class='grey'>
                    <th style="text-align: right">GIR</td>
                    @foreach( $backNine as $hole )
                        <td>{!!Form::checkbox('GIRs[]', $hole->hole_number, false,['class' => 'checkcheky'])!!}</td>
                    @endforeach
                    <td></td>
                </tr>
                <tr class="white">
                    <th style="text-align: right">FAIRWAY</td>
                    @foreach( $backNine as $hole )
                        <td>{!!Form::checkbox('fairways[]', $hole->hole_number, false,['class' => 'checkcheky'])!!}</td>
                    @endforeach
                    <td></td>
                </tr>
                <tr class='grey'>
                    <th style="text-align: right">PENALTY</td>
                    @foreach( $backNine as $hole )
                        <td>{!!Form::checkbox('penalties[]', $hole->hole_number, false,['class' => 'checkcheky'])!!}</td>
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
                    <th colspan="11">
                        <a href={!!url('/scorecard/'.$scorecard->id.'/edit')!!} class="btn btn-danger btn-sm">Edit Scorecard</a>
                        <a href={!!url('/')!!} class="btn btn-primary btn-sm">Home</a>
                        {!!Form::submit( 'Enter Round', ['class'=>'btn btn-success btn-sm'] )!!}
                    </th>
                </tr>
            </table>
        </div>
    </div>
</div>
{!!Form::close()!!}
@endsection --}}
