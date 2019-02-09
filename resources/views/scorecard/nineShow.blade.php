@extends('layouts.template')
@section('content')
<div class="flex-center position-ref full-height">
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
                <td>{!!$hole->nole_number!!}</td>
            @endforeach
            <th>OUT</th>
        </tr>
        <tr class="white">
            <th style="text-align: right">WHITE TEES</th>
            @foreach ($scorecard->holes as $hole )
                <td id='scoreField'>{!!$hole->whites!!}</td>
            @endforeach
            <td>{!!$scorecard->holes->sum('whites')!!}</td>
        </tr>
        <tr class='green'>
            <th style="text-align: right">PAR</th>
            @foreach( $scorecard->holes as $hole )
                <td id='scoreField'>{!!$hole->par!!}</td>
            @endforeach
            <td>{!!$scorecard->holes->sum('par')!!}</td>
        </tr>
        <tr class="white">
            <th style="text-align: right">SCORE</th>
            @foreach( $scorecard->holes as $hole )
                <td></td>
            @endforeach
            <td></td>
        </tr>
        <tr class='grey'>
            <th style="text-align: right">GIR</td>
            @for ($i = 0; $i < 10; $i++)
                <td></td>
            @endfor
        </tr>
        <tr class="white">
            <th style="text-align: right">FAIRWAY</td>
            @for ($i = 0; $i < 10; $i++)
                <td></td>
            @endfor
        </tr>
        <tr class='grey'>
            <th style="text-align: right">PENALTY</td>
            @for ($i = 0; $i < 10; $i++)
                <td></td>
            @endfor
        </tr>
        <tr class='gold'>
            <th style="text-align: right">HANDICAP</td>
                @foreach ($scorecard->holes as $hole)
                    <td id='scoreField'>{!!$hole->handicap!!}</td>
                @endforeach
            <td>OUT</td>
        </tr>
    </table>
</div>
@endsection
