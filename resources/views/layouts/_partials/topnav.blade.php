<nav class="navbar blue lighten-2" role="navigation">
	<div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo"><img src="/images/rebuy_logo.png" class="img-responsive"></a>
	  <ul class="right hide-on-small-and-down">
	    @if (auth()->user()->role == "owner")
		    <li><a class="dropdown-button" href="#!" data-activates="dropdown1">{{session()->get("selected_shop")->name}}<i class="material-icons right">arrow_drop_down</i></a></li>
		    <li class="hide-on-med-and-down"><a href="#" class="do-nav-slideout"><i class="material-icons">menu</i></a></li>
	    @endif
	  </ul>
	  <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
	</div>
</nav>
<ul id="dropdown1" class="dropdown-content">
	@foreach (session()->get('shops') as $shop)
		<li><a href="/shop/set/{{$shop->id}}?redirect={{base64_encode(Request::url())}}">{{$shop->name}}</a></li>
	@endforeach
</ul>