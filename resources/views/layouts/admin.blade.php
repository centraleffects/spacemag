<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
</head>

<body>
<div class="navbar-fixed">
  @include('layouts._partials.admin.topnav')
</div>
@include('layouts._partials.sidebar')

<script src="http://code.jquery.com/jquery-latest.min.js"></script> 
<!-- Compiled and minified JavaScript --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script> 
<script>
 $(".button-collapse").sideNav();
</script>
</body>
</html>