@extends('Layouts.userPanel')

@section('title', 'Registration')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="registration-page">
        <div class="links">
            <p class="actual-page">Registration</p>
            <a href="{{ route('login') }}">Login</a>
        </div>
        <form action="{{ route('createUser') }}" method="POST" name="registration">
            @csrf
            <label for="login">Login</label>
            <input id="login" name="login" type="text" value="{{ old('login') }}">
            @error('login')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="email">Email</label>
            <input id="email" name="email" type="text" value="{{ old('email') }}">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="password">Password</label>
            <input id="password" name="password" type="password">
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="password-confirmation">Confirm password</label>
            <input id="password-confirmation" name="password_confirmation" type="password">
            @error('password-confirmation')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit">Registration</button>
        </form>
    </div>
@endsection
