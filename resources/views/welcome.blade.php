@extends('layouts.app')

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
                <img src="{{ asset('img/logo-twgroup-200.png') }}" alt="">
            </div>

            <div class="links">
                <a href="https://willdone.org/">Xochitl Project</a>
                <a href="https://www.linkedin.com/in/ezra-charles-04550a167/">Linkedin | Ezra Charles</a>
                <a href="https://github.com/EzraCharles">GitHub | Ezra Charles</a>
                <a href="https://rachaelrepp.org/doctor/">Project Dr. Rachael (On development)</a>
            </div>
        </div>
    </div>
@endsection
