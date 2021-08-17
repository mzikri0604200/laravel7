<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                text-align: center;
                display: block;
            }

            .position-ref {
                position: relative;
            }

            .code {
                /* border-right: 2px solid; */
                /* font-size: 26px; */
                /* padding: 0 15px 0 15px; */
                margin-bottom: 0px;
               
            }

            .message {
                /* font-size: 18px; */
                text-align: center;
                margin: 0px;
            }

            img{   
                margin: 10% auto 0;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <img src="{{ asset('images/404.svg') }}" alt="" width="350px">
            <h1 class="code">
                @yield('code')
            </h1>

            <h2 class="message">
                @yield('message')
            </h2>
        </div>
    </body>
</html>
