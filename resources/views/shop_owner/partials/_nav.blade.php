@if( auth()->check() && auth()->user()->isOwner() )
	<li>
	    <a href="{{ url('shop') }}">
	        {!! __("Shops Status") !!}
	    </a>
	</li>
	<li>
	    <a href="{{ url('shop/customers') }}">
	        {!! __("Customers") !!}
	    </a>
	</li>
	<li>
	    <a href="{{ url('shop/clients') }}">
	        {!! __("Clients") !!}
	    </a>
	</li>
	<li>
	    <a href="{{ url('shop/spots') }}">
	       {!! __("Salespot") !!}
	    </a>
	</li>
	<li>
	    <a href="{{ url('shop/workers') }}">
	        {!! __("Shop Workers") !!}
	    </a>
	</li>
	<li>
	    <a href="{{ url('shop/todo') }}">
	        {!! __("Todo List") !!}
	    </a>
	</li>
	<li>
	    <a href="{{ url('shop/workers/todo') }}">
	        {!! __("Workers Todo") !!}
	    </a>
	</li>
	<li>
	    <a href="{{ url('shop/workers/todo') }}">
	        {!! __("Coupons") !!}
	    </a>
	</li>

@else
	<li>
		<a href="{{ url('shop') }}">Shops</a>
	</li>
@endif
