@extends('layouts.template')
@section('styles')

@endsection
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
    <div id="dayBox" style="margin-bottom:0px">
        <table id="dayTable">
            <tr class='cardHeader green-back'>
                <th colspan="13" class='courseName' style="text-align: left;padding-left:20px">Overall Stats</th>
            </tr>
            <tr>
                <td class="blue-back">Data Set</td>
                <td class="blue-back">Rounds Played</td>
                <td class="blue-back">Average Scores</td>
                <td class="blue-back">Putts Per Hole</td>
                <td class="blue-back">Birdies</td>
                <td class="blue-back">Pars</td>
                <td class="blue-back">Bogies</td>
                <td class="blue-back">GIR</td>
                <td class="blue-back">Fairways Hit</td>
                <td class="blue-back">Left</td>
                <td class="blue-back">Right</td>
                <td class="blue-back">Sand Traps</td>
                <td class="blue-back">Penalties</td>
            </tr>
            <tr>
                <td>Overall</td>
                <td>{!!$archive->overallRoundsPlayed()!!}</td>
                <td>{!!$archive->overallScore()!!}</td>
                <td>{!!$archive->overallPutts()!!}</td>
                <td>{!!$archive->overallBirdies()!!}%</td>
                <td>{!!$archive->overallPars()!!}%</td>
                <td>{!!$archive->overallBogies()!!}%</td>
                <td>{!!$archive->overallGIRs()!!}%</td>
                <td>{!!$archive->overallFairways($archive->yr)!!}%</td>
                <td>{!!$archive->overallFairwaysLeft($archive->yr)!!}%</td>
                <td>{!!$archive->overallFairwaysRight($archive->yr)!!}%</td>
                <td>{!!$archive->overallSand($archive->yr)!!}%</td>
                <td>{!!$archive->overallPenalty($archive->yr)!!}%</td>
            </tr>
        </table>
    </div>
    <div id="dayBox" style="margin-bottom:0px">
        <table id="dayTable">
            <tr class='green-back cardHeader'>
                <th colspan="14" class='courseName' style="text-align: left;padding-left:20px">Stats By Day Group</th>
            </tr>
            <tr>
                <td class="blue-back">Day Group</td>
                <td class="blue-back">Rounds Played</td>
                <td class="blue-back">Average Scores</td>
                <td class="blue-back">Putts Per Hole</td>
                <td class="blue-back">Birdies</td>
                <td class="blue-back">Pars</td>
                <td class="blue-back">Bogies</td>
                <td class="blue-back">GIR</td>
                <td class="blue-back">Fairways Hit</td>
                <td class="blue-back">Left</td>
                <td class="blue-back">Right</td>
                <td class="blue-back">Sand Traps</td>
                <td class="blue-back">Penalties</td>
            </tr>
            @foreach($days as $day)
                <tr>
                    <td>{!!$day->name!!}</td>
                    <td>{!!$archive->getDayRounds($day->name)!!}</td>
                    <td>{!!$archive->getDayScoreAvg($day->name)!!}</td>
                    <td>{!!$archive->getDayPutts($day->name)!!}</td>
                    <td>{!!$archive->getDayBirdies($day->name)!!}%</td>
                    <td>{!!$archive->getDayPars($day->name)!!}%</td>
                    <td>{!!$archive->getDayBogies($day->name)!!}%</td>
                    <td>{!!$archive->getDayGIRs($day->name)!!}%</td>
                    <td>{!!$archive->getDayFairways($day->name)!!}%</td>
                    <td>{!!$archive->getDayFairwaysLeft($day->name)!!}%</td>
                    <td>{!!$archive->getDayFairwaysRight($day->name)!!}%</td>
                    <td>{!!$archive->getDaySand($day->name)!!}%</td>
                    <td>{!!$archive->getDayPenalty($day->name)!!}%</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div id="dayBox" style="margin-bottom:0px">
        <table id="dayTable">
            <tr class='green-back cardHeader'>
                <th colspan="14" class='courseName' style="text-align: left;padding-left:20px">Stats By Course</th>
            </tr>
            <tr>
                <td class="blue-back">Data Set</td>
                <td class="blue-back">Rounds Played</td>
                <td class="blue-back">Average Scores</td>
                <td class="blue-back">Putts Per Hole</td>
                <td class="blue-back">Birdies</td>
                <td class="blue-back">Pars</td>
                <td class="blue-back">Bogies</td>
                <td class="blue-back">GIR</td>
                <td class="blue-back">Fairways Hit</td>
                <td class="blue-back">Left</td>
                <td class="blue-back">Right</td>
                <td class="blue-back">Sand Traps</td>
                <td class="blue-back">Penalties</td>
            </tr>
            @foreach ($scorecards as $key => $scorecard)
                @if($scorecard->rounds()->count() > 0)
                    <tr>
                        <td>{!!$scorecard->name!!}</td>
                        <td>{!!$scorecard->rounds()->count()!!}</td>
                        <td>{!!$scorecard->getAvgCourseScore($archive->yr)!!}</td>
                        <td>{!!$scorecard->getAvgCoursePutts($archive->yr)!!}</td>
                        <td>{!!$scorecard->getAvgCourseBirdies($archive->yr)!!}%</td>
                        <td>{!!$scorecard->getAvgCoursePars($archive->yr)!!}%</td>
                        <td>{!!$scorecard->getAvgCourseBogies($archive->yr)!!}%</td>
                        <td>{!!$scorecard->getAvgCourseGIRs($archive->yr)!!}%</td>
                        <td>{!!$scorecard->getAvgCourseFairways($archive->yr)!!}%</td>
                        <td>{!!$scorecard->getAvgCourseFairwaysLeft($archive->yr)!!}%</td>
                        <td>{!!$scorecard->getAvgCourseFairwaysRight($archive->yr)!!}%</td>
                        <td>{!!$scorecard->getAvgCourseSand($archive->yr)!!}%</td>
                        <td>{!!$scorecard->getAvgCoursePenalty($archive->yr)!!}%</td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
    <div id="dayBox">
        <table id="dayTable">
            <tr>
                <th class="dayBoxHeader blue-back" colspan="2">Overalls</th>
            </tr>
            <tr>
                <td class="statsFirstCol">Rounds Played</td>
                <td>{{$archive->overallRoundsPlayed()}}</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Average Scores</td>
                <td>{!!$archive->overallScore()!!}</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Putts Per Hole</td>
                <td>{!!$archive->overallPutts()!!}</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Birdies</td>
                <td>{!!$archive->overallBirdies()!!}%</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Pars</td>
                <td>{!!$archive->overallPars()!!}%</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Bogies</td>
                <td>{!!$archive->overallBogies()!!}%</td>
            </tr>
            <tr>
                <td class="statsFirstCol">GIR</td>
                <td>{!!$archive->overallGIRs()!!}%</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Fairways Hit</td>
                <td>{!!$archive->overallFairways($archive->yr)!!}%</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Left</td>
                <td>{!!$archive->overallFairwaysLeft($archive->yr)!!}%</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Right</td>
                <td>{!!$archive->overallFairwaysRight($archive->yr)!!}%</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Penalties</td>
                <td>{!!$archive->overallPenalty($archive->yr)!!}%</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Sand Traps</td>
                <td>{!!$archive->overallSand($archive->yr)!!}%</td>
            </tr>
        </table>
  </div>

    @foreach ($scorecards as $key => $scorecard)
        @if($scorecard->rounds()->count() > 0)
            <div id="dayBox">
                <table id="dayTable">
                    <tr>
                        <th class="dayBoxHeader blue-back" colspan="2">{!!$scorecard->name!!}</th>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Rounds Played</td>
                        <td>{!!$scorecard->rounds()->count()!!}</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Average Scores</td>
                        <td>{!!$scorecard->getAvgCourseScore($archive->yr)!!}</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Putts Per Hole</td>
                        <td>{!!$scorecard->getAvgCoursePutts($archive->yr)!!}</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Birdies</td>
                        <td>{!!$scorecard->getAvgCourseBirdies($archive->yr)!!}%</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Pars</td>
                        <td>{!!$scorecard->getAvgCoursePars($archive->yr)!!}%</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Bogies</td>
                        <td>{!!$scorecard->getAvgCourseBogies($archive->yr)!!}%</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">GIR</td>
                        <td>{!!$scorecard->getAvgCourseGIRs($archive->yr)!!}%</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Fairways Hit</td>
                        <td>{!!$scorecard->getAvgCourseFairways($archive->yr)!!}%</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Left</td>
                        <td>{!!$scorecard->getAvgCourseFairwaysLeft($archive->yr)!!}%</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Right</td>
                        <td>{!!$scorecard->getAvgCourseFairwaysRight($archive->yr)!!}%</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Penalties</td>
                        <td>{!!$scorecard->getAvgCoursePenalty($archive->yr)!!}%</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Sand Traps</td>
                        <td>{!!$scorecard->getAvgCourseSand($archive->yr)!!}%</td>
                    </tr>
                </table>
            </div>
        @endif
    @endforeach

    @foreach ($days as $day)
            <div id="dayBox">
                <table id="dayTable">
                    <tr>
                        <th class="dayBoxHeader blue-back" colspan="2">{!!$day->name!!}</th>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Rounds Played</td>
                        <td>{!!$archive->getDayRounds($day->name)!!}</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Average Scores</td>
                        <td>{!!$archive->getDayScoreAvg($day->name)!!}</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Putts Per Hole</td>
                        <td>{!!$archive->getDayPutts($day->name)!!}</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Birdies</td>
                        <td>{!!$archive->getDayBirdies($day->name)!!}%</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Pars</td>
                        <td>{!!$archive->getDayPars($day->name)!!}%</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Bogies</td>
                        <td>{!!$archive->getDayBogies($day->name)!!}%</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">GIR</td>
                        <td>{!!$archive->getDayGIRs($day->name)!!}%</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Fairways Hit</td>
                        <td>{!!$archive->getDayFairways($day->name)!!}%</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Left</td>
                        <td>{!!$archive->getDayFairwaysLeft($day->name)!!}%</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Right</td>
                        <td>{!!$archive->getDayFairwaysRight($day->name)!!}%</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Penalties</td>
                        <td>{!!$archive->getDaySand($day->name)!!}%</td>
                    </tr>
                    <tr>
                        <td class="statsFirstCol">Sand Traps</td>
                        <td>{!!$archive->getDayPenalty($day->name)!!}%</td>
                    </tr>
                </table>
            </div>

    @endforeach




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
