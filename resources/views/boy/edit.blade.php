@extends('layouts.template')
@section('styles')
@endsection
@section('content')
    <div class="flex-container">
        <div class="flex-landing-box">
            <h3>Edit {!!$boy->first_name!!}'s Profile</h3>
            <h4>Day Groups</h4>
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
                            <p>{!!Form::checkbox('mon', 1, true,['class' => 'addBoyCheckbox'])!!} Monday</p>
                            <p>{!!Form::checkbox('wed', 1, false,['class' => 'addBoyCheckbox'])!!} Wednesday</p>
                        </div>
                        <div class="column">
                            <p>{!!Form::checkbox('fri', 1, false,['class' => 'addBoyCheckbox'])!!} Friday</p>
                            <p>{!!Form::checkbox('out', 1, false,['class' => 'addBoyCheckbox'])!!} Outing</p>
                        </div>
                    </div>
                </div>
            <a href={!! URL::previous() !!} class="btn btn-primary btn-sm">Back</a>
            {!!Form::submit('Update',['class'=>'btn btn-success btn-sm'])!!}
            {!!Form::close()!!}
        </div>
    </div>
@endsection
