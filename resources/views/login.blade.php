@extends('Layouts.userPanel')

@section('title', 'Login')

@section('content')
    <div class="registration-page">
        <div class="links">
            <a href="{{ route('registration') }}">Registration</a>
            <p class="actual-page">Login</p>
        </div>
        <form action="{{ route('loginUser') }}" method="POST" name="login">
            @csrf
            <label for="login">Login</label>
            <input id="login" name="login" type="text">

            <label for="password">Password</label>
            <input id="password" name="password" type="password">

            <button type="submit">Login</button>
        </form>
    </div>
@endsection
