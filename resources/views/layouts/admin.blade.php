<!DOCTYPE html>
<html lang="en" ng-app="rebuy" ng-class="{'full-page-map': isFullPageMap}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">


  <link rel="manifest" href="/img/favicon/manifest.json">
  <link rel="shortcut icon" href="/img/favicon/favicon.ico"> -->

  <title ng-bind="pageTitle + ' - Rebuy'">Loading... - Rebuy</title>


  @include('layouts._partials.admin.styles')
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body scroll-spy id="top">
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
