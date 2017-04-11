@if( auth()->check() && auth()->user()->isOwner() )
	<li>
	    <a href="{{ url('shop/customers') }}">Customers</a>
	</li>
	<li>
	    <a href="{{ url('shop/clients') }}">Clients</a>
	</li>
	<li>
	    <a href="#">Shop Status</a>
	</li>
	<li>
	    <a href="{{ url('shop/workers') }}">Add Shop Workers</a>
	</li>
	<li>
	    <a href="{{ url('shop/todo') }}">Todo List</a>
	</li>
	<li>
	    <a href="{{ url('shop/workers/todo') }}">Todo for workers</a>
	</li>

@else
	<li>
		<a href="{{ url('shop') }}">Shops</a>
	</li>
@endif