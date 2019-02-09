@extends('layouts.app')
@section('content')
    <div class="flex-center position-ref full-height">
         {{Form::open(['action' => 'RoundController@store'])}}

            <div class="form-group">
                {!!Form::text('course', null, ['class' => 'form-control', 'placeholder' => "course"])!!}
            </div>
            <div class="form-group">
                {!!Form::text('totalHoles', null, ['class' => 'form-control', 'placeholder' => "Total Holes"])!!}
            </div>
            <div class="form-group">
                {!!Form::submit('Click Me!')!!}
            </div>
         {!!Form::close()!!}
     </div>
@endsection
