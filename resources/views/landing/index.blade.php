@extends('layouts.template')
@section('styles')
@endsection
@section('content')
    <div class="flex-container">


        {{-- ENTER JOES SCORECARD ROUND  --}}
        <div class="flex-landing-box">
          {!!Form::open(['action' => 'RoundController@store'])!!}
              <h3>Enter Round</h3>
              <div style="padding:20px">
                  {!!Form::select('cardId', $scorecards, null, ['class'=> 'form-control', 'placeholder' => 'Select Course...'])!!}
              </div>
              <div class="btn-div">
                  {!!Form::submit('Add Round',['class'=>'btn btn-success btn-sm'])!!}
              </div>
          {!!Form::close()!!}
        </div>



        {{-- THE BOYS BOX --}}
        <div class="flex-landing-box">
            <h3>The Boys</h3>
            <!-- Enter Boy Shot -->
            @if($boys != null)
                <div style="margin: 0px 30px">
                    <div class="row">
                        <div class="column">
                            @foreach($boys as $key=>$boy)
                                <li class="flex-div-li"
                                    data-toggle="modal"
                                    data-target='#boyShot'
                                    data-id={{$boy->id}}
                                    data-firstname={{$boy->first_name}}
                                    data-id={{$boy->id}}
                                    onclick="getBoyHiddenData(this)">
                                    {!!$boy->first_name!!}
                                </li>
                            @endforeach
                        </div>
                        <div class="column">
                            @foreach($boys as $key=>$boy)
                                <li style="list-style:none">
                                    <a href={!!url('/boy/'.$boy->id)!!} class="btn btn-outline-primary btn-sm" role="button">view</a>
                                </li>
                            @endforeach
                        </div>
                        <div class="column">
                            @foreach($boys as $key=>$boy)
                                <li style="list-style:none">
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#editGolferModal" onclick="editGolferDataBind(this)">edit</button>
                                </li>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="btn-div">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addGolferModal">Add Golfer</button>
            </div>
        </div>



        {{-- CREATE NEW SCORECARD BOX --}}
        <div class="flex-landing-box">
            {!!Form::open(['action' => 'ScorecardController@store'])!!}
                <h3>Create New Scorecard</h3>
                <div>
                    {!!Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Course Name'] )!!}
                </div>
                <div class="top-margin">
                    <p>{!!Form::radio('totalHoles', '9')!!}  <span style="margin-right:25px">9 Holes</span>  {!!Form::radio('totalHoles', '18', true)!!} 18 Holes</p>
                </div>
                <div class="btn-div">
                    <a href="url('/')" class="btn btn-primary btn-sm">Back</a>
                     {!!Form::submit('Create',['class'=>'btn btn-success btn-sm'])!!}
                </div>
            {!!Form::close()!!}
        </div>




        <div class="flex-landing-box">4</div>
        <div class="flex-landing-box">5</div>
        <div class="flex-landing-box">6</div>
    </div>

{{-- modals --}}
@include('shot.create');
@include('boy.create');


@endsection

@section('scripts')
    function goDoSomething(identifier){
        document.getElementById("addGolferModalLabel").innerHTML = "Enter "+$(identifier).data('firstname')+"'s Score";
         document.getElementById("hiddenBoyId").value = $(identifier).data('id');
     }

     function editGolferDataBind(identifier){
         document.getElementById("editGolferModalLabel").innerHTML = "Enter "+$(identifier).data('firstname')+"'s Score";
          document.getElementById("hiddenBoyId").value = $(identifier).data('id');
      }
@endsection
