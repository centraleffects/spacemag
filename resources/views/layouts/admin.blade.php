<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  @include('layouts._partials._styles')
</head>
<body>
<!--    @include('layouts._partials.topnav')
  
  <div class="section" id="main-content">
    <div class="container">
    </div>
  </div>


  <div class="container">

  </div> -->
<div class="row">
   @include('layouts._partials.sidebar')
   <section class="maincontent col s12">
      
      <nav class="navbar" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo"></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="#">Settings</a></li>
            <li><a href="#" class="do-nav-slideout"><i class="material-icons">menu</i></a></li>
          </ul>
          <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
      </nav>
   </section>
</div>

@include('layouts._partials.footer')