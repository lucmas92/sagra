<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles -->
    <style>
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: .4;
            z-index: -1;
            background-position: center center;
            background-size: cover;
            background-image: url('wallpaper.jpg');
        }
    </style>
</head>
<body class="antialiased">
<div class="container text-center">

    <div class="row mt-5">
        <div class="col mt-5" style="font-size: 30px">
            @auth
                <a href="{{ route('home') }}" class="px-4 py-2 bg-dark text-white">
                    Home
                </a>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 bg-dark text-white">
                    Log in
                </a>
            @endauth
        </div>
    </div>
</div>
</body>
</html>
