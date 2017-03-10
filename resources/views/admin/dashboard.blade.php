@component('admin.layouts.app')
<div class="toolbar row">
	<div class="col s12">
		<nav>
		    <div class="nav-wrapper">
		      <ul id="nav-mobile" class="right hide-on-med-and-down">
		         <li><a href="#" class="btn btn-flat waves-effect  waves-light">Add Shop Owner</a></li>
				 <li><a href="#" class="btn btn-flat waves-effect  waves-light">List Show Owners</a></li>
				 <li><a href="#" class="btn btn-flat waves-effect  waves-light">List Shops</a></li>
		      </ul>
		    </div>
		</nav>
	</div>
</div>
<div class="row content-wrap">

	<div class="col s3">
		<div  class="white" id="dashleft-sidebar">
			<h5><i class="fa fa-caret-down" aria-hidden="true"></i> List of Shops</h5>
			<ul class="collection">
				<li class="collection-item">
					<svg class="svgIcon itemRow-dragIcon" viewBox="0 0 32 32" title="drag handle"><path d="M 14 5.5 a 3 3 0 1 1 -3 -3 A 3 3 0 0 1 14 5.5 Z m 7 3 a 3 3 0 1 0 -3 -3 A 3 3 0 0 0 21 8.5 Z m -10 4 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 12.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 12.5 Z m -10 10 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 22.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 22.5 Z"></path></svg>
					<input type="text" name="shop_name" value="Bunny Jeans">
					<i class="fa fa-pencil-square-o edit-icon" aria-hidden="true"></i>
					<i class="fa fa-trash delete-icon" aria-hidden="true"></i>
				</li>
				<li class="collection-item">
					<svg class="svgIcon itemRow-dragIcon" viewBox="0 0 32 32" title="drag handle"><path d="M 14 5.5 a 3 3 0 1 1 -3 -3 A 3 3 0 0 1 14 5.5 Z m 7 3 a 3 3 0 1 0 -3 -3 A 3 3 0 0 0 21 8.5 Z m -10 4 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 12.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 12.5 Z m -10 10 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 22.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 22.5 Z"></path></svg>
					<input type="text" name="shop_name" value="Playboy">
				</li>
				<li class="collection-item">
					<svg class="svgIcon itemRow-dragIcon" viewBox="0 0 32 32" title="drag handle"><path d="M 14 5.5 a 3 3 0 1 1 -3 -3 A 3 3 0 0 1 14 5.5 Z m 7 3 a 3 3 0 1 0 -3 -3 A 3 3 0 0 0 21 8.5 Z m -10 4 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 12.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 12.5 Z m -10 10 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 22.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 22.5 Z"></path></svg>
					<input type="text" name="shop_name" value="Vanilla Marketing">
				</li>
				<li class="collection-item">
					<svg class="svgIcon itemRow-dragIcon" viewBox="0 0 32 32" title="drag handle"><path d="M 14 5.5 a 3 3 0 1 1 -3 -3 A 3 3 0 0 1 14 5.5 Z m 7 3 a 3 3 0 1 0 -3 -3 A 3 3 0 0 0 21 8.5 Z m -10 4 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 12.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 12.5 Z m -10 10 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 22.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 22.5 Z"></path></svg>
					<input type="text" name="shop_name" value="Marco Jeans & Co.">
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
				  <li><a href="#!"><i class="fa fa-times" aria-hidden="true"></i> REMOVE</a></li>
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

</div>
@endcomponent