@extends('layouts.template')
@section('content')
<div class="flex-container">
        {{-- MONDAY GROUP --}}
    <div id="dayBox">
        <table id="dayTable">
            <tr>
                <th class="dayBoxHeader red-back" colspan="3">Monday Group</th>
            </tr>
            <tr>
                <td class="blue-back" colspan="3">Current Leader: {!!$mondayLeader->first_name!!} {!!$mondayLeader->last_name!!}</td>
            </tr>
            <tr>
                <td class="green-back">Golfer</td>
                <td class="green-back">Average Score</td>
                <td class="green-back">Strokes Recieving</td>
            </tr>
            @foreach ($mondays as $key => $mon)
                <tr>
                    @auth
                        @if($mon->id != 1)
                            <td><p class="nameClick"
                                    data-toggle="modal"
                                    data-target="#boyShot"
                                    data-id={{$mon->id}}
                                    data-firstname={{$mon->first_name}}
                                    data-day="Monday"
                                    onclick="getBoyHiddenData(this)">
                                    {!!$mon->first_name!!} {!!$mon->last_name!!}
                            </p></td>
                            <td> {!!$mon->mondayBoyAverage()!!}</td>
                            <td>{!!$mon->behindMonLeader($mondayLeader)!!}</td>
                        @else
                            <td class="gold-back">{!!$mon->first_name!!} {!!$mon->last_name!!}</td>
                            <td class="gold-back"> {!!$mon->mondayBoyAverage()!!}</td>
                            <td class="gold-back">{!!$mon->behindMonLeader($mondayLeader)!!}</td>
                        @endif
                    @else
                        <td>{!!$mon->first_name!!} {!!$mon->last_name!!}</td>
                        <td> {!!$mon->mondayBoyAverage()!!}</td>
                        <td>{!!$mon->behindMonLeader($mondayLeader)!!}</td>
                    @endauth
                </tr>
            @endforeach
        </table>
    </div>
    {{-- WEDNESDAY GROUP --}}
    <div id="dayBox">
        <table id="dayTable">
            <tr>
                <th class="dayBoxHeader red-back" colspan="3">Wednesday Group</th>
            </tr>
            <tr>
                <td class="blue-back" colspan="3">Current Leader: {!!$wednesdayLeader->first_name!!} {!!$wednesdayLeader->last_name!!}</td>
            </tr>
            <tr>
                <td class="green-back">Golfer</td>
                <td class="green-back">Average Score</td>
                <td class="green-back">Strokes Recieving</td>
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
                            <td> {!!$wed->wednesdayBoyAverage()!!}</td>
                            <td>{!!$wed->behindWedLeader($wednesdayLeader)!!}</td>
                        @else
                            <td class="gold-back">{!!$wed->first_name!!} {!!$wed->last_name!!}</td>
                            <td class="gold-back"> {!!$wed->wednesdayBoyAverage()!!}</td>
                            <td class="gold-back">{!!$wed->behindWedLeader($wednesdayLeader)!!}</td>
                        @endif
                    @else
                        <td>{!!$wed->first_name!!} {!!$wed->last_name!!}</td>
                        <td> {!!$wed->wednesdayBoyAverage()!!}</td>
                        <td>{!!$wed->behindWedLeader($wednesdayLeader)!!}</td>
                    @endauth
                </tr>
            @endforeach
        </table>
    </div>
    {{-- FRIDAY GROUP --}}
    <div id="dayBox">
        <table id="dayTable">
            <tr>
                <th class="dayBoxHeader red-back" colspan="3">Friday Group</th>
            </tr>
            <tr>
                <td class="blue-back" colspan="3">Current Leader: {!!$fridayLeader->first_name!!} {!!$fridayLeader->last_name!!}</td>
            </tr>
            <tr>
                <td class="green-back">Golfer</td>
                <td class="green-back">Average Score</td>
                <td class="green-back">Strokes Recieving</td>
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
                            <td> {!!$fri->fridayBoyAverage()!!}</td>
                            <td>{!!$fri->behindWedLeader($fridayLeader)!!}</td>
                        @else
                            <td class="gold-back">{!!$fri->first_name!!} {!!$fri->last_name!!}</td>
                            <td class="gold-back"> {!!$fri->fridayBoyAverage()!!}</td>
                            <td class="gold-back">{!!$fri->behindFriLeader($fridayLeader)!!}</td>
                        @endif
                    @else
                        <td>{!!$fri->first_name!!} {!!$fri->last_name!!}</td>
                        <td> {!!$fri->fridayBoyAverage()!!}</td>
                        <td>{!!$fri->behindWedLeader($fridayLeader)!!}</td>
                    @endauth
                </tr>
            @endforeach
        </table>
    </div>
    {{-- OUTING GROUP --}}
    <div id="dayBox">
        <table id="dayTable">
            <tr>
                <th class="dayBoxHeader red-back" colspan="3">Outing Group</th>
            </tr>
            <tr>
                <td class="blue-back" colspan="3">Current Leader: {!!$outingLeader->first_name!!} {!!$outingLeader->last_name!!}</td>
            </tr>
            <tr>
                <td class="green-back">Golfer</td>
                <td class="green-back">Average Score</td>
                <td class="green-back">Strokes Recieving</td>
            </tr>
            @foreach ($outings as $key => $out)
                <tr>
                    @auth
                        @if($out->id != 1)
                            <td><p class="nameClick"
                                    data-toggle="modal"
                                    data-target="#boyShot"
                                    data-id={{$out->id}}
                                    data-firstname={{$out->first_name}}
                                    data-day="Outing"
                                    onclick="getBoyHiddenData(this)">
                                    {!!$out->first_name!!} {!!$out->last_name!!}
                            </p></td>
                            <td> {!!$out->outingBoyAverage()!!}</td>
                            <td>{!!$out->behindOutLeader($outingLeader)!!}</td>
                        @else
                            <td class="gold-back">{!!$out->first_name!!} {!!$out->last_name!!}</td>
                            <td class="gold-back"> {!!$out->outingBoyAverage()!!}</td>
                            <td class="gold-back">{!!$out->behindFriLeader($outingLeader)!!}</td>
                        @endif
                    @else
                        <td>{!!$out->first_name!!} {!!$out->last_name!!}</td>
                        <td> {!!$out->outingBoyAverage()!!}</td>
                        <td>{!!$out->behindOutLeader($outingLeader)!!}</td>
                    @endauth
                </tr>
            @endforeach
        </table>
    </div>
    {{-- Login Container --}}
    <div class="flex-landing-box">
        @auth
            <h3>Welcome {!!Auth::user()->name!!}</h3>
            <h5 class="left">Overall Averages <a class='btn btn-outline-primary btn-sm' href="{!!url('/round')!!}">View Rounds</a></h5>





            <ul>
                <li class="flex-div-li">Score: {!!number_format($scoreAvg)!!}</li>
                <li class="flex-div-li">GIRs: {!!number_format($girAvg)!!}%</li>
                <li class="flex-div-li">Fairways: {!!number_format($fairwayAvg)!!}%</li>
                <li class="flex-div-li">Penalties: {!!number_format($penaltyAvg)!!}%</li>
                <li class="flex-div-li">Mondays: {!!number_format($joe->mondayBoyAverage())!!}</li>
                <li class="flex-div-li">Wednesdays: {!!number_format($joe->wednesdayBoyAverage())!!}</li>
                <li class="flex-div-li">Fridays: {!!number_format($joe->fridayBoyAverage())!!}</li>
                <li class="flex-div-li">Outing: {!!number_format($joe->mondayBoyAverage())!!}</li>
            </ul>
            <a style="float:right" class="btn btn-primary btn-sm" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h3>Login</h3>
                <div class="formTextFieldDiv">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder='E-Mail Address' value="{{ old('email') }}" required autofocus>
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
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                <div style="text-align: right">
                    <button type="submit" class="btn btn-success btn-sm">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        @endauth
        <div class="dropdown">
          <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Archives</button>
          <ul class="dropdown-menu">
              @foreach ($archDates as $key => $value)
                  <li><a href="{{url('/arch/'.$value)}}">{{$value}}</a></li>
              @endforeach
          </ul>
        </div>
    </div>
    {{-- List of all the easide boys box --}}
    <div class="flex-landing-box">
        <!-- Button trigger modal -->
        <h3 class="left">East Side Boys</h3>
        <ul>
            @foreach($boys as $boy)
                @if($boy->id != 1)
                    <li class="flex-div-li"><a href={!!url('/boy/'.$boy->id)!!}>{!!$boy->first_name!!} {!!$boy->last_name!!}</a></li>
                @else
                    <li class="flex-div-li greenColor">{!!$boy->first_name!!} {!!$boy->last_name!!}</li>
                @endif
            @endforeach
        </ul>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addGolferModal">Add Golfer</button>
    </div>
    @auth
        {{-- ENTER JOES SCORECARD ROUND  --}}
        <div class="flex-landing-box">
            <h3 class="left">Scorecards</h3>
            <ul>
                @foreach($scorecards as $scorecard)
                    <li class="flex-div-li"><a href={!!url('/scorecard/'.$scorecard->id)!!}>{!!$scorecard->name!!}</a></li>
                @endforeach
            </ul>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addScorecardModal">Add Scorecard</button>
        </div>
    @endauth


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
