<!DOCTYPE html>
<html lang="en" ng-app="rebuy">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
   <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link rel="manifest" href="/img/favicon/manifest.json">
  <link rel="shortcut icon" href="/img/favicon/favicon.ico">

  <title ng-bind="pageTitle + ' - Rebuy'">Loading... - Rebuy</title>


  @include('layouts._partials.admin.styles')
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body scroll-spy class="container-fluid">
  <main>
  
    <aside>
        <ul id="slide-out" class="side-nav">
          <li><div class="userView">
            <div class="background">
              <img src="images/office.jpg">
            </div>
            <a href="#!user"><img class="circle" src="/images/avatar/280.jpg"></a>
            <a href="#!name"><span class="white-text name">John Doe</span></a>
            <a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
          </div></li>
          <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
          <li><a href="#!">Second Link</a></li>
          <li><div class="divider"></div></li>
          <li><a class="subheader">Subheader</a></li>
          <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
    </aside>

    <div class="main-container">
      @include('layouts._partials.admin.topnav')
      <div class="main-content" autoscroll="true" ng-cloak ng-view bs-affix-target init-ripples></div>
    </div>
  </main>

  <div class="alert-container-top-right"></div>
    @include('layouts._partials.admin.scripts')
</body>
</html>
