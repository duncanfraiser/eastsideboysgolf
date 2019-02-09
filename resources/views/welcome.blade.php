@extends('layouts.template')
@section('content')
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                EAST SIDE BOYS GOLF CLUB
            </div>

            <!-- <div class="links">
                <h2><a href="{{url('/boy')}}">boy</a></h2>
            </div> -->
        </div>
    </div>
@endsection
