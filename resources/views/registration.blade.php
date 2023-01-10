@extends('Layouts.userPanel')

@section('title', 'Registration')

@section('content')
    <div class="registration-page">
        <div class="links">
            <p class="actual-page">Registration</p>
            <a href="{{ route('login') }}">Login</a>
        </div>
        <form action="{{ route('createUser') }}" method="POST" name="registration">
            @csrf
            <label for="login">Login</label>
            <input id="login" name="login" type="text">

            <label for="email">Email</label>
            <input id="email" name="email" type="text">

            <label for="password">Password</label>
            <input id="password" name="password" type="password">

            <label for="confirm_password">Confirm password</label>
            <input id="confirm_password" name="confirm_password" type="password">

            <button type="submit">Registration</button>
        </form>
    </div>
@endsection
