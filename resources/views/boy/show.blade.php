@extends('layouts.template')
@section('styles')
@endsection
@section('content')
    <div class="flex-container">
        <div class="flex-landing-box">
            <h3>{!!$boy->first_name!!} {!!$boy->last_name!!}</h3>
            <h4>Average: {!!$boy->boyAverage()!!}
            <h4>Day Groups</h4>
            @if($boy->monday != 0)
                <h5>Monday</h5>
            @endif
            @if($boy->wednesday != 0)
                <h5>Wednesday</h5>
            @endif
            @if($boy->friday != 0)
                <h5>Friday</h5>
            @endif
            @if($boy->out != 0)
                <h5>Outing</h5>
            @endif
            <a href={!!url('/boy/'.$boy->id.'/edit')!!} class="btn btn-outline-danger btn-sm" role="button">edit</a>
        </div>
    </div>
@endsection
