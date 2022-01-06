<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="icon" href="{{ asset('img/intersalud.ico')}}" type="image/x-icon">
        <!-- Styles -->
        <style>
            html, body {
                background: rgb(45,182,188,0.5);
                background: linear-gradient(to bottom right, rgba(207,31,64,0.4) 0%, rgba(230,156,45,0.5) 15%, rgba(230,156,45,0.1) 20%, rgba(230,156,45,0.1) 75%, rgba(230,156,45,0.3) 81%, rgba(207,31,64,0.4) 100%);
                font-family: 'Georgia';
                font-weight: 200;
                height: 100vh;
                margin: 0;
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
                color: #303030;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                text-shadow: 2px 2px 2px #fff;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            h4 {
                letter-spacing: .1rem;
                color: #636b6f;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">{{'Home'}}</a>
                    @else
                        <a href="{{ route('login') }}">{{'Login'}}</a>
                        <a href="{{ route('paciente.create') }}">{{'Registro Paciente'}}</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img src="{{ asset('img/intersalud.png')}}" width="70%">
                </div>
            </div>
        </div>
    </body>
</html>
