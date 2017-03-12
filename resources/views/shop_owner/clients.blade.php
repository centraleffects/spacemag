@component('shop_owner.layouts.app')


	<div class="col s3">
		<div  class="white" id="dashleft-sidebar">
			<h5><i class="fa fa-caret-down" aria-hidden="true"></i> List of Clients</h5>
			<ul class="collection">
				<li class="collection-item">
					@include('layouts._partials.dragicon')
					<input type="text" value="John Doe">
					<a href="#!" title="Delete"><i class="fa fa-trash"></i></a>
			    </li>

			    <li class="collection-item">
					@include('layouts._partials.dragicon')
					<input type="text" value="Johny Doer">
					<a href="#!" title="Delete"><i class="fa fa-trash"></i></a>
			    </li>
			</ul>
		</div>
	</div>
	<div class="col s6">
		<div id="list-info" class="white">
			<div class="row" id="info-nav">
				<input type="text" name="shop_name" placeholder="Shop name">
				<i data-activates="lsinfo-option" class="fa fa-ellipsis-v grey-text lighten-2 dropdown-button" aria-hidden="true" id="info-option"></i>
				<ul id="lsinfo-option" class="dropdown-content">
				  <li><a href="#!"><i class="fa fa-times" aria-hidden="true"></i> Remove</a></li>
				</ul>
			</div>
			<div class="row" id="info-content">
				<ul class="collection">
					<li class="collection-item"><textarea name="shop_description">Description</textarea></li>
					<li class="collection-item"><input type="text" name="shop_url" placeholder="Homepage"></li>
					<li class="collection-item"><input type="text" name="shop_currency" placeholder="Currency"><small class="grey-text lighten-2">This is a test</small></li>
					<li class="collection-item"><input type="text" name="shop_postel" placeholder="Postel"></li>
				</ul>	
			</div>
		</div>
	</div>
	<div class="col s3">
	</div>

@endcomponent