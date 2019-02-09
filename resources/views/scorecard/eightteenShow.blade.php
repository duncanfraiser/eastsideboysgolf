@extends('layouts.template')
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
                    <td>{!!$hole->nole_number!!}</td>
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
                <td></td>
            </tr>
            <tr class="white">
                <th style="text-align: right">SCORE</th>
                @foreach($frontNine as $hole)
                    <td></td>
                @endforeach
                <td></td>
            </tr>
            <tr class='grey'>
                <th style="text-align: right">GIR</td>
                @for($i = 0; $i < 10; $i++)
                    <td></td>
                @endfor
            </tr>
            <tr class="white">
                <th style="text-align: right">FAIRWAY</td>
                @for($i = 0; $i < 10; $i++)
                    <td></td>
                @endfor
            </tr>
            <tr class='grey'>
                <th style="text-align: right">PENALTY</td>
                @for($i = 0; $i < 10; $i++)
                    <td></td>
                @endfor
            </tr>
            <tr class='gold'>
                <th style="text-align: right">HANDICAP</td>
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
                        <td>{!!$hole->nole_number!!}</td>
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
                    <td></td>
                </tr>
                <tr class="white">
                    <th style="text-align: right">SCORE</th>
                    @foreach($backNine as $hole)
                        <td></td>
                    @endforeach
                    <td></td>
                </tr>
                <tr class='grey'>
                    <th style="text-align: right">GIR</td>
                    @for($i = 0; $i < 10; $i++)
                        <td></td>
                    @endfor
                </tr>
                <tr class="white">
                    <th style="text-align: right">FAIRWAY</td>
                    @for($i = 0; $i < 10; $i++)
                        <td></td>
                    @endfor
                </tr>
                <tr class='grey'>
                    <th style="text-align: right">PENALTY</td>
                    @for($i = 0; $i < 10; $i++)
                        <td></td>
                    @endfor
                </tr>
                <tr class='gold'>
                    <th style="text-align: right">HANDICAP</td>
                        @foreach($backNine as $hole)
                            <td id='scoreField'>{!!$hole->handicap!!}</td>
                        @endforeach
                    <td>OUT</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
