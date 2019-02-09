@extends('layouts.template')
@section('styles')
@endsection
@section('content')
    <div class="flex-container">



        <div class="flex-landing-box">
            <h3>Monday</h3>
            @foreach ($mondays as $key => $mon)
                <li class="flex-div-li"
                    data-toggle="modal"
                    data-target="#boyShot"
                    data-id={{$mon->id}}
                    data-firstname={{$mon->first_name}}
                    data-id={{$mon->id}}
                    data-day="monday"
                    onclick="getBoyHiddenData(this)">
                    {!!$mon->first_name!!}
                </li>
            @endforeach
        </div>



        <div class="flex-landing-box">
            <h3>Wednesday</h3>
            @foreach ($wednesdays as $key => $wed)
                <li class="flex-div-li"
                    data-toggle="modal"
                    data-target="#boyShot"
                    data-id={{$wed->id}}
                    data-firstname={{$wed->first_name}}
                    data-id={{$wed->id}}
                    data-day="wednesday"
                    onclick="getBoyHiddenData(this)">
                    {!!$wed->first_name!!}
                </li>
            @endforeach
        </div>



        <div class="flex-landing-box">
            <h3>Friday</h3>
            @foreach ($fridays as $key => $fri)
                <li class="flex-div-li"
                    data-toggle="modal"
                    data-target="#boyShot"
                    data-id={{$fri->id}}
                    data-firstname={{$fri->first_name}}
                    data-id={{$fri->id}}
                    data-day="friday"
                    onclick="getBoyHiddenData(this)">
                    {!!$fri->first_name!!}
                </li>
            @endforeach
        </div>


        <div class="flex-landing-box">
            <h3>Outing</h3>
            @foreach ($outings as $key => $out)
                <li class="flex-div-li"
                    data-toggle="modal"
                    data-target="#boyShot"
                    data-id={{$out->id}}
                    data-firstname={{$out->first_name}}
                    data-id={{$out->id}}
                    data-day="outing"
                    onclick="getBoyHiddenData(this)">
                    {!!$out->first_name!!}
                </li>
            @endforeach
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
