@extends('layouts.template')
@section('content')
<div class="flex-container">
    {{-- Login Container --}}
    <div class="flex-landing-box green-back">
        @auth
            <div class="left">
                <span class="boxHeader">Welcome Joe</span>
                {{-- ADD GOLFER --}}
                <button style="float:bottom;width:100%" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addGolferModal">Add Golfer</button>
                {{-- ADD SCORECARD --}}
                <button type="button" style="width:100%" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addScorecardModal">Add Scorecard</button>
                {{-- EASTSIDE BOYS --}}
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" style="width:100%" type="button" data-toggle="dropdown">East Side Boys</button>
                    <ul class="dropdown-menu">
                        @foreach($boys as $boy)
                                <li style="color:red"><a href={!!url('/boy/'.$boy->id)!!}>{!!$boy->first_name!!} {!!$boy->last_name!!}</a></li>
                        @endforeach
                    </ul>
                </div>
                {{-- ENTER ROUND --}}
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" style="width:100%" type="button" data-toggle="dropdown">Enter Round</button>
                    <ul class="dropdown-menu">
                         @foreach($scorecards as $scorecard)
                            <li><a href={!!url('/scorecard/'.$scorecard->id)!!}>{!!$scorecard->name!!}</a></li>
                        @endforeach
                    </ul>
                </div>
                {{-- STATS --}}
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" style="width:100%" type="button" data-toggle="dropdown">Stats</button>
                    <ul class="dropdown-menu">
                        @foreach ($archDates as $key => $value)
                            <li style><a href="{{url('/arch/'.$value)}}">{{$value}}</a></li>
                        @endforeach
                    </ul>
                </div>
                {{-- VIEW ROUNDS --}}
                <a style="width:100%" href={!!url('/round')!!} class="btn btn-primary btn-sm">View Rounds</a>

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
        @else
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h3>Login</h3>
                <div class="formTextFieldDiv">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder='E-Mail Address' value="{{ old('email') }}" required>
                </div>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <div class="formTextFieldDiv">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder='Password' required>
                </div>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <div class="form-check" style="font-size:16px">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                <div style="text-align: right">
                    <button type="submit" class="btn btn-primary btn-sm">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        @endauth
    </div>
    {{-- MONDAY GROUP --}}
    <div id="dayBox">
        <table id="dayTable">
            <tr>
                <th class="dayBoxHeader green-back" colspan="4">Monday Group</th>
            </tr>
            <tr>
                <td class="blue-back">Golfer</td>
                <td class="blue-back">Total Skins</td>
                <td class="blue-back">Average Score</td>
                <td class="blue-back">Strokes Recieving</td>
            </tr>
            @foreach ($mondays as $key => $mon)
                <tr>
                    @auth
                        @if($mon->id != 1)
                            <td class="greenColor"><p class="nameClick "
                                    data-toggle="modal"
                                    data-target="#boyShot"
                                    data-id={{$mon->id}}
                                    data-firstname={{$mon->first_name}}
                                    data-day="Monday"
                                    onclick="getBoyHiddenData(this)">
                                    {!!$mon->first_name!!} {!!$mon->last_name!!}
                            </p></td>
                            <td>{!!$mon->mondayBoySkin()!!}</td>
                            <td>{!!$mon->mondayBoyAverage()!!}</td>
                            @if($mon->id == $mondayLeader->id)
                                <td class="greenColor">Leader</td>
                            @else
                                @if($mon->behindMonLeader($mondayLeader) != 0)
                                    @if($mon->behindMonLeader($mondayLeader) > 12)
                                        <td class="greenColor"><span class="redColor">Max +12 </span>: {!!$mon->behindMonLeader($mondayLeader)!!}</td>
                                    @else
                                        <td class="greenColor">+{!!$mon->behindMonLeader($mondayLeader)!!}</td>
                                    @endif
                                @else
                                    <td class="redColor">{!!$mon->behindMonLeader($mondayLeader)!!}</td>
                                @endif
                            @endif
                        @else
                            <td class="red-back">{!!$mon->first_name!!} {!!$mon->last_name!!}</td>
                            <td class="red-back">{!!$mon->mondayBoySkin()!!}</td>
                            <td class="red-back">{!!$mon->mondayBoyAverage()!!}</td>
                            @if($mon->id == $mondayLeader->id)
                                <td class=" red-back">Leader</td>
                            @else
                                @if($mon->behindMonLeader($mondayLeader) != 0)
                                    @if($mon->behindMonLeader($mondayLeader) > 12)
                                        <td class="red-back"> Max +12 : {!!$mon->behindMonLeader($mondayLeader)!!}</td>
                                    @else
                                        <td class="red-back">+{!!$mon->behindMonLeader($mondayLeader)!!}</td>
                                    @endif
                                @else
                                    <td class="red-back">{!!$mon->behindMonLeader($mondayLeader)!!}</td>
                                @endif
                            @endif
                        @endif
                    @else
                        <td><a href={!!url('/boy/'.$mon->id)!!}>{!!$mon->first_name!!} {!!$mon->last_name!!}</a></td>
                        <td> {!!$mon->mondayBoySkin()!!}</td>
                        <td> {!!$mon->mondayBoyAverage()!!}</td>
                        @if($mon->id == $mondayLeader->id)
                            <td class="greenColor">Leader</td>
                        @else
                            @if($mon->behindMonLeader($mondayLeader) != 0)
                                @if($mon->behindMonLeader($mondayLeader) > 12)
                                    <td class="greenColor"><span class="redColor">Max +12 </span>: {!!$mon->behindMonLeader($mondayLeader)!!}</td>
                                @else
                                    <td class="greenColor">+{!!$mon->behindMonLeader($mondayLeader)!!}</td>
                                @endif
                            @else
                                <td class="redColor">{!!$mon->behindMonLeader($mondayLeader)!!}</td>
                            @endif
                        @endif
                    @endauth
                </tr>
            @endforeach
        </table>
    </div>

    {{-- WEDNESDAY GROUP --}}
    <div id="dayBox">
        <table id="dayTable">
            <tr>
                <th class="dayBoxHeader green-back" colspan="4">Wednesday Group</th>
            </tr>
            <tr>
                <td class="blue-back">Golfer</td>
                <td class="blue-back">Total Skins</td>
                <td class="blue-back">Average Score</td>
                <td class="blue-back">Strokes Recieving</td>
            </tr>
            @foreach ($wednesdays as $key => $wed)
                <tr>
                    @auth
                        @if($wed->id != 1)
                            <td><p class="nameClick"
                                    data-toggle="modal"
                                    data-target="#boyShot"
                                    data-id={{$wed->id}}
                                    data-firstname={{$wed->first_name}}
                                    data-day="Wednesday"
                                    onclick="getBoyHiddenData(this)">
                                    {!!$wed->first_name!!} {!!$wed->last_name!!}
                            </p></td>
                            <td>{!!$wed->wednesdayBoySkin()!!}</td>
                            <td>{!!$wed->wednesdayBoyAverage()!!}</td>
                            @if($wed->id == $wednesdayLeader->id)
                                <td class="greenColor">Leader</td>
                            @else
                                @if($wed->behindWedLeader($wednesdayLeader) != 0)
                                    @if($wed->behindWedLeader($wednesdayLeader) > 12)
                                        <td class="greenColor"><span class="redColor">Max +12 </span>: {!!$wed->behindWedLeader($wednesdayLeader)!!}</td>
                                    @else
                                        <td class="greenColor">+{!!$wed->behindWedLeader($wednesdayLeader)!!}</td>
                                    @endif
                                @else
                                    <td class="redColor">{!!$wed->behindWedLeader($wednesdayLeader)!!}</td>
                                @endif
                            @endif
                        @else
                            <td class="red-back">{!!$wed->first_name!!} {!!$wed->last_name!!}</td>
                            <td class="red-back">{!!$wed->wednesdayBoySkin()!!}</td>
                            <td class="red-back">{!!$wed->wednesdayBoyAverage()!!}</td>
                            @if($wed->id == $wednesdayLeader->id)
                                <td class="red-back">Leader</td>
                            @else
                                @if($wed->behindWedLeader($wednesdayLeader) != 0)
                                    @if($wed->behindWedLeader($wednesdayLeader) > 12)
                                        <td class="red-back">Max +12 : {!!$wed->behindWedLeader($wednesdayLeader)!!}</td>
                                    @else
                                        <td class="red-back">+{!!$wed->behindWedLeader($wednesdayLeader)!!}</td>
                                    @endif
                                @else
                                    <td class="red-back">{!!$wed->behindWedLeader($wednesdayLeader)!!}</td>
                                @endif
                            @endif
                        @endif
                    @else
                        <td><a href={!!url('/boy/'.$wed->id)!!}>{!!$wed->first_name!!} {!!$wed->last_name!!}</a></td>
                        <td> {!!$wed->wednesdayBoySkin()!!}</td>
                        <td> {!!$wed->wednesdayBoyAverage()!!}</td>
                        @if($wed->id == $wednesdayLeader->id)
                            <td class="greenColor">Leader</td>
                        @else
                            @if($wed->behindWedLeader($wednesdayLeader) != 0)
                                @if($wed->behindWedLeader($wednesdayLeader) > 12)
                                    <td class="greenColor"><span class="redColor">Max +12 </span>: {!!$wed->behindWedLeader($wednesdayLeader)!!}</td>
                                @else
                                    <td class="greenColor">+{!!$wed->behindWedLeader($wednesdayLeader)!!}</td>
                                @endif
                            @else
                                <td class="redColor">{!!$wed->behindWedLeader($wednesdayLeader)!!}</td>
                            @endif
                        @endif
                    @endauth
                </tr>
            @endforeach
        </table>
    </div>

    {{-- FRIDAY GROUP --}}
    <div id="dayBox">
        <table id="dayTable">
            <tr>
                <th class="dayBoxHeader green-back" colspan="4">Friday Group</th>
            </tr>
            <tr>
                <td class="blue-back">Golfer</td>
                <td class="blue-back">Average Score</td>
                <td class="blue-back">Total Skins</td>
                <td class="blue-back">Strokes Recieving</td>
            </tr>
            @foreach ($fridays as $key => $fri)
                <tr>
                    @auth
                        @if($fri->id != 1)
                            <td><p class="nameClick"
                                    data-toggle="modal"
                                    data-target="#boyShot"
                                    data-id={{$fri->id}}
                                    data-firstname={{$fri->first_name}}
                                    data-day="Friday"
                                    onclick="getBoyHiddenData(this)">
                                    {!!$fri->first_name!!} {!!$fri->last_name!!}
                            </p></td>
                            <td>{!!$fri->fridayBoyAverage()!!}</td>
                            <td>{!!$fri->fridayBoySkin()!!}</td>
                            @if($fri->id == $fridayLeader->id)
                                <td class="greenColor">Leader</td>
                            @else
                                @if($fri->behindFriLeader($fridayLeader) != 0)
                                    @if($fri->behindFriLeader($fridayLeader) > 12)
                                        <td class="greenColor"><span class="redColor">Max +12 </span>: {!!$fri->behindFriLeader($fridayLeader)!!}</td>
                                    @else
                                        <td class="greenColor">+{!!$fri->behindFriLeader($fridayLeader)!!}</td>
                                    @endif
                                @else
                                    <td class="redColor">{!!$fri->behindFriLeader($fridayLeader)!!}</td>
                                @endif
                            @endif
                        @else
                            <td class="red-back">{!!$fri->first_name!!} {!!$fri->last_name!!}</td>
                            <td class="red-back">{!!$fri->fridayBoySkin()!!}</td>
                            <td class="red-back">{!!$fri->fridayBoyAverage()!!}</td>
                            @if($fri->id == $fridayLeader->id)
                                <td class="red-back">Leader</td>
                            @else
                                @if($fri->behindFriLeader($fridayLeader) != 0)
                                    @if($fri->behindFriLeader($fridayLeader) > 12)
                                        <td class="red-back">Max +12 : {!!$fri->behindFriLeader($fridayLeader)!!}</td>
                                    @else
                                        <td class="red-back">+{!!$fri->behindFriLeader($fridayLeader)!!}</td>
                                    @endif
                                @else
                                    <td class="red-back">{!!$fri->behindFriLeader($fridayLeader)!!}</td>
                                @endif
                            @endif
                        @endif
                    @else
                        <td><a href={!!url('/boy/'.$fri->id)!!}>{!!$fri->first_name!!} {!!$fri->last_name!!}</a></td>
                        <td> {!!$fri->fridayBoySkin()!!}</td>
                        <td> {!!$fri->fridayBoyAverage()!!}</td>
                        @if($fri->id == $fridayLeader->id)
                            <td class="greenColor">Leader</td>
                        @else
                            @if($fri->behindFriLeader($fridayLeader) != 0)
                                @if($fri->behindFriLeader($fridayLeader) > 12)
                                    <td class="greenColor"><span class="redColor">Max +12 </span>: {!!$fri->behindFriLeader($fridayLeader)!!}</td>
                                @else
                                    <td class="greenColor">+{!!$fri->behindFriLeader($fridayLeader)!!}</td>
                                @endif
                            @else
                                <td class="redColor">{!!$fri->behindFriLeader($fridayLeader)!!}</td>
                            @endif
                        @endif
                    @endauth
                </tr>
            @endforeach
        </table>
    </div>

    {{-- OUTING GROUP --}}
    <div id="dayBox">
        <table id="dayTable">
            <tr>
                <th class="dayBoxHeader green-back" colspan="4">Outing Group</th>
            </tr>
            <tr>
                <td class="blue-back">Golfer</td>
                <td class="blue-back">Total Skin</td>
                <td class="blue-back">Average Score</td>
                <td class="blue-back">Strokes Recieving</td>
            </tr>
            @foreach ($outings as $key => $out)
                <tr>
                    @auth
                        @if($out->id != 1)
                            <td><p class="nameClick"wmhfq
                                    data-toggle="modal"
                                    data-target="#boyShot"
                                    data-id={{$out->id}}
                                    data-firstname={{$out->first_name}}
                                    data-day="Outing"
                                    onclick="getBoyHiddenData(this)">
                                    {!!$out->first_name!!} {!!$out->last_name!!}
                            </p></td>
                            <td>{!!$out->outingBoySkin()!!}</td>
                            <td>{!!$out->outingBoyAverage()!!}</td>
                            @if($out->id == $outingLeader->id)
                                <td class="greenColor">Leader</td>
                            @else
                                @if($out->behindOutLeader($outingLeader) != 0)
                                    @if($out->behindOutLeader($outingLeader) > 12)
                                        <td class="greenColor"><span class="redColor">Max +12 </span>: {!!$out->behindOutLeader($outingLeader)!!}</td>
                                    @else
                                        <td class="greenColor">+{!!$out->behindOutLeader($outingLeader)!!}</td>
                                    @endif
                                @else
                                    <td class="redColor">{!!$out->behindOutLeader($outingLeader)!!}</td>
                                @endif
                            @endif
                        @else
                            <td class="red-back">{!!$out->first_name!!} {!!$out->last_name!!}</td>
                            <td class="red-back">{!!$out->outingBoySkin()!!}</td>
                            <td class="red-back">{!!$out->outingBoyAverage()!!}</td>
                            @if($out->id == $outingLeader->id)
                                <td class="red-back">Leader</td>
                            @else
                                @if($out->behindOutLeader($outingLeader) != 0)
                                    @if($out->behindOutLeader($outingLeader) > 12)
                                        <td class="red-back">Max +12 : {!!$out->behindOutLeader($outingLeader)!!}</td>
                                    @else
                                        <td class="red-back">+{!!$out->behindOutLeader($outingLeader)!!}</td>
                                    @endif
                                @else
                                    <td class="red-back">{!!$out->behindOutLeader($outingLeader)!!}</td>
                                @endif
                            @endif
                        @endif
                    @else
                        <td><a href={!!url('/boy/'.$out->id)!!}>{!!$out->first_name!!} {!!$out->last_name!!}</a></td>
                        <td>{!!$out->outingBoySkin()!!}</td>
                        <td>{!!$out->outingBoyAverage()!!}</td>
                        @if($out->id == $outingLeader->id)
                            <td class="greenColor">Leader</td>
                        @else
                            @if($out->behindOutLeader($outingLeader) != 0)
                                <td class="greenColor">+{!!$out->behindOutLeader($outingLeader)!!}</td>
                            @else
                                <td class="redColor">{!!$out->behindOutLeader($outingLeader)!!}</td>
                            @endif
                        @endif
                    @endauth
                </tr>
            @endforeach
        </table>
    </div>

    {{-- Play-To-Play GROUP --}}
    <div id="dayBox">
        <table id="dayTable">
            <tr>
                <th class="dayBoxHeader green-back" colspan="3">Play-To-Play Group</th>
            </tr>
            <tr>
                <td class="blue-back">Golfer</td>
                <td class="blue-back">Total Skins</td>
                <td class="blue-back">Average Score</td>
            </tr>
            @foreach ($playToPlay as $key => $ptp)
                <tr>
                    @auth
                        @if($ptp->id != 1)
                            <td><p class="nameClick"
                                    data-toggle="modal"
                                    data-target="#boyShot"
                                    data-id={{$ptp->id}}
                                    data-firstname={{$ptp->first_name}}
                                    data-day="Play-To-Play"
                                    onclick="getBoyHiddenData(this)">
                                    {!!$ptp->first_name!!} {!!$ptp->last_name!!}
                            </p></td>
                            <td>{!!$ptp->playToPlayBoySkin()!!}</td>
                            <td>{!!$ptp->playToPlayBoyAverage()!!}</td>
                        @else
                            <td class="red-back">{!!$ptp->first_name!!} {!!$ptp->last_name!!}</td>
                            <td class="red-back">{!!$ptp->playToPlayBoySkin()!!}</td>
                            <td class="red-back">{!!$ptp->playToPlayBoyAverage()!!}</td>
                        @endif
                    @else
                        <td><a href={!!url('/boy/'.$ptp->id)!!}>{!!$ptp->first_name!!} {!!$ptp->last_name!!}</a></td>
                        <td>{!!$ptp->playToPlayBoySkin()!!}</td>
                        <td> {!!$ptp->playToPlayBoyAverage()!!}</td>
                    @endauth
                </tr>
            @endforeach
        </table>
    </div>
</div>
{{-- modals --}}
@include('shot.create')
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


@endsection
