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
        <link rel="stylesheet" href="{{ mix('/css/vendor.css') }}">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body class="page-login theme-template-blue theme-light-green" init-ripples>
        <div class="center bg-clouds">
            <div class="row">   
                <div class="col-md-6 col-md-offset-3">
                    <div class="logo-holder">
                        <a href="/"><img src="/img/rebuy_logo.png" class="img-responsive"></a>
                    </div>
                    <div class="card bordered z-depth-2"  style="margin:0% auto; max-width: 400px;">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ mix('/js/login.js') }}"></script>
        <script src="{{ mix('/js/app.js') }}"></script>
        
        @yield('scripts')
    </body>
</html>
