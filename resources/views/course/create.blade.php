{{-- @extends('layouts.app')
@section('content')
    <div class="flex-center position-ref full-height">
         {{Form::open(['action' => 'CourseController@store'])}}
            {{Form::text('name', null, ['class' => 'form-control', 'placeholder' => "Course Name"])}}
        <div class="form-group">
            {{Form::radio('totalHoles', '9')}}
            {{Form::label('totalHoles', '9 Holes')}}
        </div>
        <div class="form-group">
            {{Form::radio('totalHoles', '18')}}
            {{Form::label('totalHoles', '18 Holes')}}
        </div>
        <div class="form-group">
            {{Form::submit('Click Me!')}}
        </div>
         {{Form::close()}}
    </div>
@endsection --}}
