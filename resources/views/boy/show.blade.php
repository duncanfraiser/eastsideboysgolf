


@extends('layouts.template')
@section('styles')
@endsection
@section('content')
<div class="flex-container">
    @auth
        {{-- Login Container --}}
        <div class="flex-landing-box green-back">
            <div class="left">
                <span class="boxHeader">Welcome Joe</span>
                {{-- ADD GOLFER --}}
                <button style="width:100%" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addGolferModal">Add Golfer</button>
                {{-- ADD SCORECARD --}}
                <button type="button" style="width:100%" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addScorecardModal">Add Scorecard</button>
                {{-- DELETE BOY --}}
                {!!Form::open(['method' => 'DELETE', 'route' => ['boy.destroy', $boy->id], 'id' => 'deleter'])!!}
                    {!!Form::submit('Delete '. $boy->first_name, [ 'class' => 'btn btn-primary btn-sm', 'style'=>'width:100%'])!!}
                {!!Form::close()!!}
                {{-- EASTSIDE BOYS --}}
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" style="width:100%" type="button" data-toggle="dropdown">East Side Boys</button>
                    <ul class="dropdown-menu">
                        @foreach($boys as $esb)
                                <li style="color:red"><a href={!!url('/boy/'.$esb->id)!!}>{!!$esb->first_name!!} {!!$esb->last_name!!}</a></li>
                        @endforeach
                    </ul>
                </div>
                {{-- EDIT BOY --}}
                <a href={!!url('/boy/'.$boy->id.'/edit')!!} class="btn btn-primary btn-sm" style="width:100%">Edit {{$boy->first_name}}</a>
                {{-- ENTER ROUND --}}
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" style="width:100%" type="button" data-toggle="dropdown">Enter Round</button>
                    <ul class="dropdown-menu">
                         @foreach($scorecards as $scorecard)
                            <li><a href={!!url('/scorecard/'.$scorecard->id)!!}>{!!$scorecard->name!!}</a></li>
                        @endforeach
                    </ul>
                </div>
                {{-- VIEW ROUNDS --}}
                <a style="width:100%" href={!!url('/')!!} class="btn btn-primary btn-sm">Return Home</a>
                {{-- STATS --}}
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" style="width:100%" type="button" data-toggle="dropdown">Stats</button>
                    <ul class="dropdown-menu">
                        @foreach ($archDates as $key => $value)
                            <li style><a href="{{url('/arch/'.$value)}}">{{$value}}</a></li>
                        @endforeach
                    </ul>
                </div>
                {{-- LOGOUT --}}
                <a class="btn btn-primary btn-sm" style="width:100%" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    @endauth
    <div id="dayBox">
        <table id="dayTable">
            <tr>
                <th colspan="4" class='dayBoxHeader green-back'>{!!$boy->first_name!!} {!!$boy->last_name!!}</th>
            </tr>
            <tr>
                <th colspan="4" class='red-back boyOverAvg'>Overall Average: {!!$boy->boyAverage()!!}</th>
            </tr>
            <tr class='blue-back'>
                <td>Day Group</td>
                <td>Total Skins</td>
                <td>Average by day</td>
                <td>Strokes From Leader</td>
            </tr>
            @if($boy->monday != 0)
                <tr>
                    <td><stronge>Monday</strong></td>
                    <td>{!!$boy->mondayBoySkin()!!}</td>
                    <td>{!!$boy->mondayBoyAverage()!!}</td>
                    @if($boy->id != $mondayLeader->id)
                        @if($boy->behindMonLeader($mondayLeader) != 0)
                            <td class="greenColor">+{!!$boy->behindMonLeader($mondayLeader)!!}</td>
                        @else
                            <td class="redColor">{!!$boy->behindMonLeader($mondayLeader)!!}</td>
                        @endif
                    @else
                        <td class="greenColor">Leader</td>
                    @endif
                </tr>
            @endif

            @if($boy->wednesday != 0)
                <tr>
                    <td><stronge>Wednesday</stronge></td>
                    <td>{!!$boy->wednesdayBoySkin()!!}</td>
                    <td>{!!$boy->wednesdayBoyAverage()!!}</td>
                    @if($boy->id != $wednesdayLeader->id)
                        @if($boy->behindWedLeader($wednesdayLeader) != 0)
                            <td class="greenColor">+{!!$boy->behindWedLeader($wednesdayLeader)!!}</td>
                        @else
                            <td class="redColor">{!!$boy->behindWedLeader($wednesdayLeader)!!}</td>
                        @endif
                    @else
                        <td class="greenColor">Leader</td>
                    @endif
                </tr>
            @endif
            @if($boy->friday != 0)
                <tr>
                    <td><stronge>Friday</stronge></td>
                    <td>{!!$boy->fridayBoySkin()!!}</td>
                    <td>{!!$boy->fridayBoyAverage()!!}</td>
                    @if($boy->id != $fridayLeader->id)
                        @if($boy->behindFriLeader($fridayLeader) != 0)
                            <td class="greenColor">+{!!$boy->behindFriLeader($fridayLeader)!!}</td>
                        @else
                            <td class="redColor">{!!$boy->behindFriLeader($fridayLeader)!!}</td>
                        @endif
                    @else
                        <td class="greenColor">Leader</td>
                    @endif
                </tr>
            @endif
            @if($boy->outing != 0)
                <tr>
                    <td><stronge>Outing</stronge></td>
                    <td>{!!$boy->outingBoySkin()!!}</td>
                    <td>{!!$boy->outingBoyAverage()!!}</td>
                    @if($boy->id != $outingLeader->id)
                        @if($boy->behindOutLeader($outingLeader) != 0)
                            <td class="greenColor">+{!!$boy->behindOutLeader($outingLeader)!!}</td>
                        @else
                            <td class="redColor">{!!$boy->behindOutLeader($outingLeader)!!}</td>
                        @endif
                    @else
                        <td class="greenColor">Leader</td>
                    @endif
                </tr>
            @endif
            @guest
                <tr class='button-row'>
                    <th colspan="11" class="green-back">
                        <a href={!!url('/')!!} class="btn btn-primary btn-sm" style="float:right;margin-right:5px">Return Home</a>
                    </th>
                </tr>
            @endguest
        </table>
    </div>
    @if($boy->monday != 0)
        <div id="dayBox">
            <table id="dayTable">
                <tr>
                    @auth
                        <th colspan="4" class='green-back dayBoxHeader'>Monday Rounds</th>
                    @else
                        <th colspan="3" class='green-back dayBoxHeader'>Monday Rounds</th>
                    @endauth
                </tr>
                <tr class='blue-back'>
                    <td>Date</td>
                    <td>Skins</td>
                    <td>Total</td>
                    @auth
                        <td class="greenColor"><button type="button" class="btn btn-success btn-sm"
                                data-toggle="modal"
                                data-target="#boyShot"
                                data-id={{$boy->id}}
                                data-firstname={{$boy->first_name}}
                                data-day="Monday"
                                onclick="getBoyHiddenData(this)">
                                Add Round
                        </button></td>
                    @endauth
                </tr>
                @foreach ($mon as $day)
                    <tr>
                        <td>{!!$day->created_at->format('m/d')!!}</td>
                        <td>{!!$day->skin!!}</td>
                        <td>{!!$day->total!!}</td>
                        @auth
                            <td>
                                {!!Form::open(['method' => 'DELETE', 'route' => ['shot.destroy', $day->id], 'id' => 'deleter'])!!}
                                    {!!Form::submit('Delete', [ 'class' => 'btn-sm btn-outline-danger'])!!}
                                {!!Form::close()!!}
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
    @if($boy->wednesday != 0)
        <div id="dayBox">
            <table id="dayTable">
                <tr>
                    @auth
                        <th colspan="4" class='green-back dayBoxHeader'>Wednesday Rounds</th>
                    @else
                        <th colspan="3" class='green-back dayBoxHeader'>Wednesday Rounds</th>
                    @endauth

                </tr>
                <tr class='blue-back'>
                    <td>Date</td>
                    <td>Skins</td>
                    <td>Total</td>
                    @auth
                        <td class="greenColor"><button type="button" class="btn btn-success btn-sm"
                                data-toggle="modal"
                                data-target="#boyShot"
                                data-id={{$boy->id}}
                                data-firstname={{$boy->first_name}}
                                data-day="Wednesday"
                                onclick="getBoyHiddenData(this)">
                                Add Round
                        </button></td>
                    @endauth
                </tr>
                @foreach ($wed as $day)
                    <tr>
                        <td>{!!$day->created_at->format('m/d')!!}</td>
                        <td>{!!$day->skin!!}</td>
                        <td>{!!$day->total!!}</td>
                        @auth
                            <td>
                                {!!Form::open(['method' => 'DELETE', 'route' => ['shot.destroy', $day->id], 'id' => 'deleter'])!!}
                                    {!!Form::submit('Delete', [ 'class' => 'btn-sm btn-outline-danger'])!!}
                                {!!Form::close()!!}
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
    @if($boy->friday != 0)
        <div id="dayBox">
            <table id="dayTable">
                <tr>
                    @auth
                    <th colspan="4" class='green-back dayBoxHeader'>Friday Rounds</th>
                    @else
                    <th colspan="3" class='green-back dayBoxHeader'>Friday Rounds</th>
                    @endauth
                </tr>
                <tr class='blue-back'>
                    <td>Date</td>
                    <td>Skins</td>
                    <td>Total</td>
                    @auth
                        <td class="greenColor"><button type="button" class="btn btn-success btn-sm"
                                data-toggle="modal"
                                data-target="#boyShot"
                                data-id={{$boy->id}}
                                data-firstname={{$boy->first_name}}
                                data-day="Friday"
                                onclick="getBoyHiddenData(this)">
                                Add Round
                        </button></td>
                    @endauth
                </tr>
                @foreach ($fri as $day)
                    <tr>
                        <td>{!!$day->created_at->format('m/d')!!}</td>
                        <td>{!!$day->skin!!}</td>
                        <td>{!!$day->total!!}</td>
                        @auth
                            <td>
                                {!!Form::open(['method' => 'DELETE', 'route' => ['shot.destroy', $day->id], 'id' => 'deleter'])!!}
                                    {!!Form::submit('Delete', [ 'class' => 'btn-sm btn-outline-danger'])!!}
                                {!!Form::close()!!}
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
    @if($boy->outing!=0)
        <div id="dayBox">
            <table id="dayTable">
                <tr>
                    @auth
                        <th colspan="4" class='green-back dayBoxHeader'>Outing Rounds</th>
                    @else
                        <th colspan="3" class='green-back dayBoxHeader'>Outing Rounds</th>
                    @endauth
                </tr>
                <tr class='blue-back'>
                    <td>Date</td>
                    <td>Skins</td>
                    <td>Total</td>
                    @auth
                        <td class="greenColor"><button type="button" class="btn btn-success btn-sm"
                                data-toggle="modal"
                                data-target="#boyShot"
                                data-id={{$boy->id}}
                                data-firstname={{$boy->first_name}}
                                data-day="Outing"
                                onclick="getBoyHiddenData(this)">
                                Add Round
                        </button></td>
                    @endauth
                </tr>
                @foreach ($out as $day)
                    <tr>
                        <td>{!!$day->created_at->format('m/d')!!}</td>
                        <td>{!!$day->skin!!}</td>
                        <td>{!!$day->total!!}</td>
                        @auth
                            <td>
                                {!!Form::open(['method' => 'DELETE', 'route' => ['shot.destroy', $day->id], 'id' => 'deleter'])!!}
                                    {!!Form::submit('Delete', [ 'class' => 'btn-sm btn-outline-danger'])!!}
                                {!!Form::close()!!}
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
    @if($boy->play_to_play!=0)
        <div id="dayBox">
            <table id="dayTable">
                <tr>
                    @auth
                        <th colspan="4" class='green-back dayBoxHeader'>Play-To-Play Rounds</th>
                    @else
                        <th colspan="3" class='green-back dayBoxHeader'>Play-To-Play Rounds</th>
                    @endauth
                </tr>
                <tr class='blue-back'>
                    <td>Date</td>
                    <td>Skins</td>
                    <td>Total</td>
                    @auth
                        <td class="greenColor"><button type="button" class="btn btn-success btn-sm"
                                data-toggle="modal"
                                data-target="#boyShot"
                                data-id={{$boy->id}}
                                data-firstname={{$boy->first_name}}
                                data-day="Play-To-Play"
                                onclick="getBoyHiddenData(this)">
                                Add Round
                        </button></td>
                    @endauth
                </tr>
                @foreach ($ptp as $day)
                    <tr>
                        <td>{!!$day->created_at->format('m/d')!!}</td>
                        <td>{!!$day->skin!!}</td>
                        <td>{!!$day->total!!}</td>
                        @auth
                            <td>
                                {!!Form::open(['method' => 'DELETE', 'route' => ['shot.destroy', $day->id], 'id' => 'deleter'])!!}
                                    {!!Form::submit('Delete', [ 'class' => 'btn-sm btn-outline-danger'])!!}
                                {!!Form::close()!!}
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
</div>
<!-- Enter Shot Modal -->
<div class="modal fade" id='boyShot' tabindex="-1" role="dialog" aria-labelledby="addGolferModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content green-back">
      {!!Form::open(['action' => 'ShotController@store'])!!}
      {!!Form::hidden('page', 'boyShow')!!}
        <div class="modal-header">
            <p class="modal-title dayBoxHeader" id="addGolferModalLabel"></p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div style="margin:15px">
                <input type="hidden" name="boyId" id="hiddenBoyId">
                <input type="hidden" name="boyDay" id="hiddenBoyDay">
                <input type="text" class="form-control" style="margin-bottom:5px" placeholder="Score" name="total" required>
                <input type="text" class="form-control" placeholder="Skin" name="skin" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
          {!!Form::submit('Add Score',['class'=>'btn btn-primary btn-sm'])!!}
        </div>
      {!!Form::close()!!}
    </div>
  </div>
</div>
{{-- modals --}}
@include('boy.create')
@include('scorecard.create')
@endsection
@section('scripts')
    function getBoyHiddenData(identifier){
        document.getElementById("addGolferModalLabel").innerHTML = "Enter "+$(identifier).data('firstname')+"'s "+$(identifier).data('day')+" Group Score";
         document.getElementById("hiddenBoyId").value = $(identifier).data('id');
         document.getElementById("hiddenBoyDay").value = $(identifier).data('day');
     }

     function editGolferDataBind(identifier){
         document.getElementById("editGolferModalLabel").innerHTML = "Enter "+$(identifier).data('firstname')+"'s Score";
          document.getElementById("hiddenBoyId").value = $(identifier).data('id');
      }

      $("#deleter").on("submit", function(){
          return confirm("Are you sure you want to delete {{$boy->first_name}} from the boys?");
      });
@endsection
