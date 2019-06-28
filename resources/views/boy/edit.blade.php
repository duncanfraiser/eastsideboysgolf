@extends('layouts.template')
@section('styles')
@endsection
@section('content')
    <div class="flex-container">
        <div class="flex-landing-box green-back">
            <p class="modal-title dayBoxHeader">Edit {!!$boy->first_name!!}'s Profile</p>
            {!!Form::model($boy, ['method' => 'PATCH', 'action' => ['BoyController@update', $boy->id]])!!}
                <div style="padding:5px">
                    {{Form::text('first_name', null, ['class' => 'form-control'])}}
                </div>
                <div style="padding:5px">
                    {{Form::text('last_name', null, ['class' => 'form-control'])}}
                </div>
                <div class="left" style="margin: 0px 30px">
                    <div class="row">
                        <div class="column">
                            <p style="margin-bottom:0px">{!!Form::checkbox('mon', 1, $boy->monday,['class' => 'addBoyCheckbox'])!!} Monday</p>
                            <p style="margin-bottom:0px">{!!Form::checkbox('wed', 1, $boy->wednesday,['class' => 'addBoyCheckbox'])!!} Wednesday</p>
                            <p style="margin-bottom:0px">{!!Form::checkbox('ptp', 1, $boy->play_to_play,['class' => 'addBoyCheckbox'])!!} Play-To-Play</p>
                        </div>
                        <div class="column">
                            <p style="margin-bottom:0px">{!!Form::checkbox('fri', 1, $boy->friday,['class' => 'addBoyCheckbox'])!!} Friday</p>
                            <p style="margin-bottom:0px">{!!Form::checkbox('out', 1, $boy->outing,['class' => 'addBoyCheckbox'])!!} Outing</p>
                        </div>
                    </div>
                </div>
            {!!Form::submit('Update',['class'=>'btn btn-primary btn-sm', 'style'=>"float:right;margin-right:5px"])!!}
            {!!Form::close()!!}
            <a href={!! URL::previous() !!} class="btn btn-primary btn-sm" style="float:right;margin-right:5px">Back</a>
        </div>
    </div>
@endsection
