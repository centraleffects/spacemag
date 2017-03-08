<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>{{ $title or '' }}</title>
        <!-- CSS  -->
        @include('layouts._partials._styles')
    </head>
    <body class="page-{{ collect(\Request::segments())->implode('-') }} bg-clouds">
    	<div class="container">
    		<div class="centered">
    			@include('layouts._partials.logo')
    		</div>
    	</div>
	    <div class="container">
	    	{{ $slot }}
	    </div>
    	
		<footer class="page-footer">
			<div class="container">
				<div class="row">
					<div class="col l6 s12">
						<h5 class="white-text">Nyheter</h5>
							<p class="grey-text text-lighten-4">
							Rebuy är nu ett registrerat varumärke.
						</p>
					</div>
				</div>
			</div>
			<div class="footer-copyright blue lighten-2">
				<div class="container">
					&copy; 2017 Rebuy &trade;  
				</div>
			</div>
		</footer>

		<!--  Scripts-->
		@include('layouts._partials._scripts')

  	</body>
</html>