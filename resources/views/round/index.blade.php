@extends('layouts.template')
@section('content')
    <div class="flex-container">
        <div id="dayBox">
            <table id="dayTable">
                <tr>
                    <th colspan="3" class='dayBoxHeader gold'>Joe's Rounds</th>
                </tr>
                <tr>
                    <th class='red'>Date</th>
                    <th class='blue'>Course</th>
                    <th class='green'>Score</th>
                </tr>
                @foreach($rounds as $round)
                        <tr>
                            <td><a href='{!!url('/round/'.$round->id)!!}'>{!!date('m/d', strtotime($round->created_at))!!}</a></td>
                            <td><a href='{!!url('/round/'.$round->id)!!}'>{!!$round->scorecard->name!!}</a></td>
                            <td><a href='{!!url('/round/'.$round->id)!!}'>{!!$round->total_score!!}</a></td>
                        </tr>
                @endforeach
                <tr class='button-row'>
                    <th colspan="3">
                        <a href={!!URL::previous()!!} class="btn btn-primary btn-sm">Back</a>
                        <a href={!!url('/')!!} class="btn btn-success btn-sm">Home</a>
                    </th>
                </tr>
            </table>
        </div>
    </div>
@endsection
