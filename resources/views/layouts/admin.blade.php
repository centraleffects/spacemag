<!DOCTYPE html>
<html lang="en" ng-app="rebuy" ng-class="{'full-page-map': isFullPageMap}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Materialism Angular Admin Theme">
  <meta name="author" content="Theme Guys - The Netherlands">
<!-- 
  <meta name="msapplication-TileColor" content="#9f00a7">
  <meta name="msapplication-TileImage" content="/assets/img/favicon/mstile-144x144.png">
  <meta name="msapplication-config" content="/assets/img/favicon/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">

  <link rel="apple-touch-icon" sizes="57x57" href="/assets/img/favicon/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/assets/img/favicon/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/favicon/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/favicon/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/favicon/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/favicon/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/assets/assets/img/favicon/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/assets/img/favicon/apple-touch-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicon/apple-touch-icon-180x180.png">

  <link rel="icon" type="image/png" href="/assets/img/favicon/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="/assets/img/favicon/android-chrome-192x192.png" sizes="192x192">
  <link rel="icon" type="image/png" href="/assets/img/favicon/favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="/assets/img/favicon/favicon-16x16.png" sizes="16x16">

  <link rel="manifest" href="/assets/img/favicon/manifest.json">
  <link rel="shortcut icon" href="/assets/img/favicon/favicon.ico"> -->

  <title ng-bind="pageTitle + ' - Rebuy'">Loading... - Rebuy</title>


  @include('layouts._partials.admin.styles')
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body ng-controller="MainController" scroll-spy id="top" ng-class="[theme.template, theme.color]">
  <main>
   
    @include('layouts._partials.sidebar')

    <div class="main-container">
      @include('layouts._partials.admin.topnav')
      <div class="main-content" autoscroll="true" ng-cloak ng-view bs-affix-target init-ripples></div>
    </div>
  </main>

  <div class="alert-container-top-right"></div>
    @include('layouts._partials.admin.scripts')
</body>
</html>
