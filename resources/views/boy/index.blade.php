@extends('layouts.template')
@section('styles')
@endsection
@section('content')
    <div class="flex-container">
        <div id="dayBox">
            <table id="dayTable">
                <tr>
                    <th colspan="3" class='dayBoxHeader'>Monday</th>
                </tr>
                <tr>
                    <th colspan="3">Current Leader: {!!$mondayLeader->first_name!!} {!!$mondayLeader->last_name!!}</th>
                </tr>
                <tr>
                    <th>Golfer</th>
                    <th>Average Score</th>
                    <th>Strokes Given</th>
                </tr>
                @foreach ($mondays as $key => $mon)
                    <tr>
                        <td>
                            <a data-toggle="modal"
                                data-target="#boyShot"
                                data-id={{$mon->id}}
                                data-firstname={{$mon->first_name}}
                                data-id={{$mon->id}}
                                data-day="monday"
                                onclick="getBoyHiddenData(this)">
                                {!!$mon->first_name!!} {!!$mon->last_name!!}
                            </a>
                        </td>
                        <td> {!!$mon->mondayBoyAverage()!!}</td>
                        <td>{!!$mon->behindMonLeader($mondayLeader)!!}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div id="dayBox">
            <table id="dayTable">
                <tr>
                    <th colspan="3" class='dayBoxHeader'>Wednesday</th>
                </tr>
                <tr>
                    <th colspan="3">Current Leader: {!!$wednesdayLeader->first_name!!} {!!$wednesdayLeader->last_name!!}</th>
                </tr>
                <tr>
                    <th>Golfer</th>
                    <th>Average Score</th>
                    <th>Strokes Given</th>
                </tr>
                @foreach ($wednesdays as $key => $wed)
                    <tr>
                        <td>
                            <a data-toggle="modal"
                                data-target="#boyShot"
                                data-id={{$wed->id}}
                                data-firstname={{$wed->first_name}}
                                data-id={{$wed->id}}
                                data-day="wednesday"
                                onclick="getBoyHiddenData(this)">
                                {!!$wed->first_name!!} {!!$wed->last_name!!}
                            </a>
                        </td>
                        <td> {!!$wed->wednesdayBoyAverage()!!}</td>
                        <td>{!!$wed->behindWedLeader($wednesdayLeader)!!}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
{{-- modals --}}
@include('shot.create');
@include('boy.create');
@endsection
@section('scripts')
    function getBoyHiddenData(identifier){
        document.getElementById("addGolferModalLabel").innerHTML = "Enter "+$(identifier).data('firstname')+"'s Score";
         document.getElementById("hiddenBoyId").value = $(identifier).data('id');
         document.getElementById("hiddenBoyDay").value = $(identifier).data('day');
     }

     function editGolferDataBind(identifier){
         document.getElementById("editGolferModalLabel").innerHTML = "Enter "+$(identifier).data('firstname')+"'s Score";
          document.getElementById("hiddenBoyId").value = $(identifier).data('id');
      }
@endsection
