@extends('Layouts.userPanel')

@section('title', 'Personal Page')

@section('content')
    <div class="personal-page">
        <div class="left-panel">
            <p onclick="userInfo()" class="user-info-button">Персональная информация</p>
            <p onclick="generateToken()" class="generate-token-button">Генерация токена</p>
        </div>
        <div class="home-content">
            <div id="user-info" class="active">
                <p>Ваш логин - {{ $user->login }}</p>
                <p>Ваш email - {{ $user->email }}</p>
            </div>
            <div id="generate-token">
                @if (!empty($user->api_token))
                    <p class="token">Ваш api токен - {{ $user->api_token }}</p>
                @else
                    <p class="token">У вас нет api токена</p>
                @endif
                <a href="{{ route('generateToken') }}" class="generate">Сгенерировать новый токен</a>
            </div>
        </div>
    </div>

    <script>
        function userInfo() {
            document.getElementById("generate-token").classList.remove("active");

            document.getElementById("user-info").classList.add("active");
        }

        function generateToken() {
            document.getElementById("user-info").classList.remove("active");

            document.getElementById("generate-token").classList.add("active");
        }
    </script>
@endsection
