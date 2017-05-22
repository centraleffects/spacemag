<nav class="navbar blue lighten-2" role="navigation">
	<div class="nav-wrapper container">
		<a id="logo-container" href="#" class="brand-logo"><img src="/images/rebuy_logo.png" class="img-responsive"></a>
	  	<ul class="right hide-on-small-and-down">
		    @if (auth()->user()->role == "owner")
			    @if( session()->has('selected_shop') )
			    	<li>
				    	<a class="dropdown-button" href="#!" data-activates="dropdown1">
				    		{{session()->get("selected_shop")->name}}<i class="material-icons right">arrow_drop_down</i>
				    	</a>
				    </li>
			    @endif
			@elseif (auth()->user()->role == "admin")    
				 <li class="hide-on-med-and-down">
					<a href="">
						{{auth()->user()->first_name.' '.auth()->user()->last_name}}<i class="material-icons right">perm_identity</i></i>
					</a>
				 </li>
			@else

		    @endif
		    
	   	<li class="hide-on-med-and-down"><a href="#" class="do-nav-slideout"><i class="material-icons">menu</i></a></li>
	  	</ul>
	  	<!-- Languages Dropdown Trigger -->
		<a class='dropdown-button right' href='#' data-activates='dropdown_languages'>
			{{ Config::get('languages')[App::getLocale()] }} <i class="material-icons right">arrow_drop_down</i>
		</a>
	  	<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
	</div>

	<ul id="dropdown1" class="dropdown-content">
		@if (!empty(session()->get('shops')))
			@foreach (session()->get('shops') as $shop)
				<li><a href="/shop/set/{{$shop->id}}?redirect={{base64_encode(Request::url())}}">{{$shop->name}}</a></li>
			@endforeach
		@endif
	</ul>
	<!-- Dropdown Structure -->
	<ul id='dropdown_languages' class='dropdown-content'>
		
		@foreach (Config::get('languages') as $lang => $language)
	        @if ($lang != App::getLocale())
	            <li>
	                <a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
	            </li>
	        @endif
	    @endforeach
	</ul>
	
</nav>


