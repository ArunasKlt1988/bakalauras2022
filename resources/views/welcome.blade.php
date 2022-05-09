<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DSP</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {



            background: linear-gradient(to bottom,white 50%,#32a852 100%);
            background-size: cover;
            color: powderblue;
            font-family: 'Nunito', sans-serif;
            font-weight: 1000;
            height: 100vh;
            margin: 0;

        }

        img {
            display: block;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            opacity: 0.6;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #fff;
            opacity: 1;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a style="color:#484343" href="{{ route('login') }}">Prisijungti</a>

            <!-- @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>-->
                @endif
            @endauth
        </div>
    @endif

    <div style="color:#484343" , class="content">
        <div class="title m-b-md">
            DSP <br> Darbuotojų sveikatos patikra
        </div>

    </div>
</div>
</body>
</html>
