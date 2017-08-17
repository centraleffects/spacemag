<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>{{ $title or '' }}</title>
        <!-- CSS  -->
        @include('layouts._partials._styles')
    </head>
    <body class="bg-clouds">
    	<div class="container">
    		<div class="section">
	    		<div class="centered">
	    			@include('layouts._partials.logo')
	    		</div>
	    	</div>
		    <div class="section">
		    	{{ $slot }}
		    </div>
    	</div>
    	<div class="container hide-on-small-only">
    		@include('layouts._partials.clouds')
    	</div>
    	
		<footer class="page-footer no-bg">
			<div class="container">
				<div class="row">
					<div class="col l6 s12" style="mix-blend-mode: screen;">
						<h5>Nyheter</h5>
							<p>
							Rebuy är nu ett registrerat varumärke.
						</p>
					</div>
				</div>
			</div>
			<div class="footer-copyright blue lighten-2">
				<div class="container">
					&copy; 2017 Rebuy &reg;  
				</div>
			</div>
		</footer>

		<!--  Scripts-->
		@include('layouts._partials._scripts')

		{{ $scripts or '' }}

	    @if(Session::has("flash_message"))
	        <script type="text/javascript">
	            $("div.alert").not(".alert-important").delay(5000).slideUp(function(){
	                $(this).remove();
	            });
	        </script>
	    @endif
  	</body>
</html>