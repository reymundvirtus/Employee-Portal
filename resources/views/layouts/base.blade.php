<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/landing2.css') }}">
        <title>@yield('title')</title>
    </head>
    <style>
        body {
            background-image: url('images/bg.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }
    </style>
    <body>
        {{-- <img src="{{ asset('images/bg.jpg') }}" alt="bg"> --}}
        <nav class="p-6 flex slider_bg_1 justify-between mb-6 fixed w-full">
            <ul class="flex items-center">
                {{-- <li>
                    <a class="p-3" href="{{ route('home') }}">Home</a>
                </li> --}}
                <li>
                    {{-- <a class="p-3" href="{{ route('dashboard') }}">Dashboard</a> --}}
                </li>
                <li>
                    {{-- <a class="p-3" href="{{ route('posts') }}">Post</a> --}}
                </li>
            </ul>

            <ul class="flex items-center">
                @auth
                    <li>
                        <a class="p-3" href="#">{{ auth()->user()->name }}</a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="p-3 inline">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>                    
                @endauth

                @guest
                    @yield('log')
                @endguest
            </ul>
        </nav>
        @yield('content')
    </body>
</html>