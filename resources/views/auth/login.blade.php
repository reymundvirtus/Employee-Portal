@extends('layouts.base') <!-- this is extending in base.blade.php file. You can use slash(/) or dot(.) -->
@section('title')
    Login
@endsection

@section('log')
    <li>
        <a class="p-3 text-white" href="{{ route('landing') }}">Home</a>
    </li>
    {{-- <li>
        <a class="p-3 text-white" href="{{ route('register') }}">Register</a>
    </li> --}}
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="w-7/12 bg-indigo-600 shadow-lg shadow-indigo-900 p-6 rounded-lg mt-24">
            <div class="text-center mb-7 text-white font-bold text-xl">
                Login
            </div>
            <form action="{{ route('login') }}" method="POST">
                @if (session('status'))
                    <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('status') }}
                    </div>
                @endif
                @csrf
                <div class="mb-4">
                    <label for="email" class="sr-only">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Your email" class="bg-blue-200 border-2 w-full h-12 p-4 rounded-lg" value="{{ old('email') }}" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Your password" class="bg-blue-200 border-2 w-full h-12 p-4 rounded-lg" value="" required>
                </div>

                <div class="mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2">
                        <label for="remember" class="text-white">Remember Me</label>
                    </div>
                </div>

                <div>
                    <button type="submit" class="bg-pink-600 hover:shadow-xl duration-300 text-white px-4 py-3 rounded font-medium w-full">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection