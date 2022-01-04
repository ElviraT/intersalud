<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="icon" href="{{ asset('img/logo.png')}}" type="image/x-icon">
        <!-- Styles -->
        <style>
            html, body {
                background: rgb(241,241,246);
                background: linear-gradient(90deg, rgba(241,241,246,1) 0%, rgba(174,174,205,1) 20%, rgba(151,221,255,1) 100%);
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
                color: #636b6f;
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
                   <h4>{{'INTERSALUD'}}</h4>
                    <img src="{{ asset('img/imagen_fondo.png')}}" width="30%" style="margin-top: -100px;">
                </div>
            </div>
        </div>
    </body>
</html>
