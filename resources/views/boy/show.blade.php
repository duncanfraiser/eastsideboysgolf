@extends('layouts.template')
@section('styles')
@endsection
@section('content')
    <div class="flex-container">
        <div class="flex-landing-box left">
            <h3 class='left'>{!!$boy->first_name!!} {!!$boy->last_name!!}</h3>
            <p>Overall Average: {!!$boy->boyAverage()!!}</p>
            <h4>Average: {!!$boy->boyAverage()!!}
            <h4>Day Groups</h4>
            <ul>
                @if($boy->monday != 0)
                    <li class="flex-div-li">Monday</li>
                @endif
                @if($boy->wednesday != 0)
                    <li class="flex-div-li">Wednesday</li>
                @endif
                @if($boy->friday != 0)
                    <li class="flex-div-li">Friday</li>
                @endif
                @if($boy->out != 0)
                    <li class="flex-div-li">Outing</li>
                @endif
            </ul>
            <a href={!!url('/boy/'.$boy->id.'/edit')!!} class="btn btn-outline-danger btn-sm" role="button">edit</a>
        </div>


        <div id="dayBox">
            <table id="dayTable">
                <tr>
                    <th colspan="3" class='dayBoxHeader red left'>{!!$boy->first_name!!} {!!$boy->last_name!!}</th>
                </tr>
                <tr>
                    <th colspan="3" class='gold' style="font-size:16px">Overall Average: {!!$boy->boyAverage()!!}</th>
                </tr>
                <tr class='blue'>
                    <td>Day Group</td>
                    <td>Average by day</td>
                    <td>Strokes From Leader</td>
                </tr>
                @if($boy->monday != 0)
                    <tr>
                        <td class='green'>Monday</td>
                        <td>{!!$boy->mondayBoyAverage()!!}</td>
                        @if($boy->behindMonLeader($mondayLeader) != 0)
                            <td class="greenColor">+{!!$boy->behindMonLeader($mondayLeader)!!}</td>
                        @else
                            <td class="redColor">{!!$boy->behindMonLeader($mondayLeader)!!}</td>
                        @endif
                    </tr>
                @endif
                @if($boy->wednesday != 0)
                    <tr>
                        <td class='green'>Wednesday</td>
                        <td>{!!$boy->wednesdayBoyAverage()!!}</td>
                        @if($boy->behindWedLeader($wednesdayLeader) != 0)
                            <td class="greenColor">+{!!$boy->behindWedLeader($wednesdayLeader)!!}</td>
                        @else
                            <td class="redColor">{!!$boy->behindWedLeader($wednesdayLeader)!!}</td>
                        @endif
                    </tr>
                @endif
                @if($boy->friday != 0)
                    <tr>
                        <td class='green'>Friday</td>
                        <td>{!!$boy->fridayBoyAverage()!!}</td>
                        @if($boy->behindFriLeader($fridayLeader) != 0)
                            <td class="greenColor">+{!!$boy->behindFriLeader($fridayLeader)!!}</td>
                        @else
                            <td class="redColor">{!!$boy->behindFriLeader($fridayLeader)!!}</td>
                        @endif
                    </tr>
                @endif
                @if($boy->outing != 0)
                    <tr>
                        <td class='green'>Outing</td>
                        <td>{!!$boy->outingBoyAverage()!!}</td>
                        @if($boy->behindOutLeader($outingLeader) != 0)
                            <td class="greenColor">+{!!$boy->behindOutLeader($outingLeader)!!}</td>
                        @else
                            <td class="redColor">{!!$boy->behindOutLeader($outingLeader)!!}</td>
                        @endif
                    </tr>
                @endif
                <tr class='button-row'>
                    <th colspan="11" style="text-align:right">
                        <a href={!! URL::previous() !!} class="btn btn-outline-danger btn-sm">Delete</a>
                        <a href={!! URL::previous() !!} class="btn btn-outline-success btn-sm">Back</a>
                        <a href={!!url('/boy/'.$boy->id.'/edit')!!} class="btn btn-outline-primary btn-sm">Edit</a>
                    </th>
                </tr>



            </table>
        </div>


    </div>
@endsection
