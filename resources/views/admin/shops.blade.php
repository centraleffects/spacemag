@component('admin.layouts.app')
<div ng-controller="adminShopController">
	<div class="col s3">
		<div  class="white" id="dashleft-sidebar" ng-model="shops">
			<h5><i class="material-icons">store</i> List of Shops</h5>
			<ul class="collection" ng-repeat="(key, shop) in shops.data">

						<li class="collection-item" ng-click="events.viewShop(key,shop)">
							<svg class="svgIcon itemRow-dragIcon" viewBox="0 0 32 32" title="drag handle"><path d="M 14 5.5 a 3 3 0 1 1 -3 -3 A 3 3 0 0 1 14 5.5 Z m 7 3 a 3 3 0 1 0 -3 -3 A 3 3 0 0 0 21 8.5 Z m -10 4 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 12.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 12.5 Z m -10 10 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 22.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 22.5 Z"></path></svg>
							<span><a href="">@{{shop.name}}</a></span> 
							<a href="#">
								<i class="fa fa-pencil-square-o edit-icon right" aria-hidden="true"></i>
							</a>
						</li>

					
				</ul>
		</div>
	</div>
	<div class="col s6 map-area-container" id="mapsection">
		<div class="scrollspy panzoom-parent map-area" id="floorplan-container">
			<img class="panzoom" ng-click="events.addShopSpot($(this))" src="/floorplan/floor1.jpg" width="2426" height="1121" data-width="2426" data-height="1121"/>
		</div>
		<div class="buttons">
	        <button class="zoom-in">Zoom In</button>
	        <button class="zoom-out">Zoom Out</button>
	        <input type="range" class="zoom-range">
	        <button class="reset">Reset</button>
	      </div>
	</div>
	<div class="col s3">
		<div id="list-info" class="white">
			<div class="row" id="info-nav">
				<input type="text" name="shop_name" placeholder="Shop name">
				<i data-activates="lsinfo-option" class="fa fa-ellipsis-v grey-text lighten-2 dropdown-button" aria-hidden="true" id="info-option"></i>
				<ul id="lsinfo-option" class="dropdown-content">
				  <li><a href="#!"  onclick="$.ReBuy.alertDialog('test');"><i class="fa fa-times" aria-hidden="true"></i> REMOVE</a></li>
				  <li><a href="#!"  onclick="$.ReBuy.confirmDialog('test', function(){ console.log('ok'); });"><i class="fa fa-times" aria-hidden="true"></i> REMOVE 2</a></li>
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
</div>
@endcomponent