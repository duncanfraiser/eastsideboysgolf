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
        <div id="dayBox">
            <table id="dayTable">
                <tr>
                    <th colspan="3" class='dayBoxHeader green-back'>Monday Group Rounds</th>
                </tr>
                <tr>
                    <td class='red-back'>Date</td>
                    <td class='red-back'>Course</td>
                    <td class='red-back'>Score</td>
                </tr>
                @foreach($rounds as $round)
                    @if($round->day == 'Monday')
                        <tr>
                            <td><a class="clickRound" href='{!!url('/round/'.$round->id)!!}'>{!!date('m/d', strtotime($round->created_at))!!}</a></td>
                            <td><a class="clickRound" href='{!!url('/round/'.$round->id)!!}'>{!!$round->scorecard->name!!}</a></td>
                            <td><a class="clickRound" href='{!!url('/round/'.$round->id)!!}'>{!!$round->total_score!!}</a></td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
        <div id="dayBox">
            <table id="dayTable">
                <tr>
                    <th colspan="3" class='dayBoxHeader green-back'>Wednesday Group Rounds</th>
                </tr>
                <tr>
                    <td class='red-back'>Date</td>
                    <td class='red-back'>Course</td>
                    <td class='red-back'>Score</td>
                </tr>
                @foreach($rounds as $round)
                    @if($round->day == 'Wednesday')
                        <tr>
                            <td><a class="clickRound" href='{!!url('/round/'.$round->id)!!}'>{!!date('m/d', strtotime($round->created_at))!!}</a></td>
                            <td><a class="clickRound" href='{!!url('/round/'.$round->id)!!}'>{!!$round->scorecard->name!!}</a></td>
                            <td><a class="clickRound" href='{!!url('/round/'.$round->id)!!}'>{!!$round->total_score!!}</a></td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
        <div id="dayBox">
            <table id="dayTable">
                <tr>
                    <th colspan="3" class='dayBoxHeader green-back'>Friday Group Rounds</th>
                </tr>
                <tr>
                    <td class='red-back'>Date</td>
                    <td class='red-back'>Course</td>
                    <td class='red-back'>Score</td>
                </tr>
                @foreach($rounds as $round)
                    @if($round->day == 'Friday')
                        <tr>
                            <td><a class="clickRound" href='{!!url('/round/'.$round->id)!!}'>{!!date('m/d', strtotime($round->created_at))!!}</a></td>
                            <td><a class="clickRound" href='{!!url('/round/'.$round->id)!!}'>{!!$round->scorecard->name!!}</a></td>
                            <td><a class="clickRound" href='{!!url('/round/'.$round->id)!!}'>{!!$round->total_score!!}</a></td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
        <div id="dayBox">
            <table id="dayTable">
                <tr>
                    <th colspan="3" class='dayBoxHeader green-back'>Outing Rounds</th>
                </tr>
                <tr>
                    <td class='red-back'>Date</td>
                    <td class='red-back'>Course</td>
                    <td class='red-back'>Score</td>
                </tr>
                @foreach($rounds as $round)
                    @if($round->day == 'Outing')
                        <tr>
                            <td><a class="clickRound"  href='{!!url('/round/'.$round->id)!!}'>{!!date('m/d', strtotime($round->created_at))!!}</a></td>
                            <td><a class="clickRound"  href='{!!url('/round/'.$round->id)!!}'>{!!$round->scorecard->name!!}</a></td>
                            <td><a class="clickRound"  href='{!!url('/round/'.$round->id)!!}'>{!!$round->total_score!!}</a></td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
        <div id="dayBox">
            <table id="dayTable">
                <tr>
                    <th colspan="3" class='dayBoxHeader green-back'>Play-To-Play Rounds</th>
                </tr>
                <tr>
                    <td class='red-back'>Date</td>
                    <td class='red-back'>Course</td>
                    <td class='red-back'>Score</td>
                </tr>
                @foreach($rounds as $round)
                    @if($round->day == 'Play-To-Play')
                        <tr>
                            <td><a class="clickRound" href='{!!url('/round/'.$round->id)!!}'>{!!date('m/d', strtotime($round->created_at))!!}</a></td>
                            <td><a class="clickRound" href='{!!url('/round/'.$round->id)!!}'>{!!$round->scorecard->name!!}</a></td>
                            <td><a class="clickRound"  href='{!!url('/round/'.$round->id)!!}'>{!!$round->total_score!!}</a></td>
                        </tr>
                    @endif
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
