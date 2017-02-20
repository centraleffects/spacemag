<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" ng-app="materialism">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Rebuy') }}</title>
        
        <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/favicon-32.png">
        <link rel="icon" sizes="32x32" href="/img/favicon/favicon-32.png" type="image/png">
        <link rel="icon" sizes="64x64" href="/img/favicon/favicon-64.png" type="image/png">
        <link rel="icon" sizes="96x96" href="/img/favicon/favicon-96.png" type="image/png">
        <link rel="icon" href="/img/favicon/favicon.png" type="image/png">
        <link rel="shortcut icon" href="/img/favicon/favicon.ico" type="image/x-icon">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body class="page-login theme-template-blue theme-light-green" init-ripples>
        <div class="center bg-clouds" id="app">
            <div class="card bordered z-depth-2"  style="margin:0% auto; max-width:400px;">
                <div class="card-header">
                    <div class="brand-logo">
                        <div id="logo"></div>
                        
                        <a href="/">
                            <img class="img-responsive" src="/img/rebuy_logo.png">
                        </a>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>

        <script charset="utf-8" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script charset="utf-8" src="/js/app.js"></script>
        <script src="/js/login.js"></script>
        @yield('scripts')
    </body>
</html>
