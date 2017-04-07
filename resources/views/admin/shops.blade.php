@component('admin.layouts.app')
<div ng-controller="adminShopController">
	<div class="col s3">
		<div  class="white" id="dashleft-sidebar" ng-model="shops">
			<h5><i class="material-icons">store</i> List of Shops</h5>
			<ul class="collection" ng-repeat="(key, shop) in shops.data">

						<li id="@{{'sh'+ shop.id}}" class="collection-item" ng-click="events.viewShop(key,shop)">
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
			<div class="panzoom"  style="background: url(/floorplan/floor1.jpg);width: 2426px; height: 1121px;" width="2426" height="1121" data-width="2426" data-height="1121"/>
				<div ng-repeat="(key, shop) in shops.data">
					<div class="shopspot tooltipped" 
							id="@{{'sp'+ shop.id}}" 
							data-position="bottom" data-delay="50" 
							ng-show="shop.x_coordinate"
							ng-click="events.viewShop(key,shop);"
							data-tooltip="@{{shop.name}}" 
							style="@{{ 'margin-left:' + shop.x_coordinate + 'px; margin-top:' + shop.y_coordinate + 'px'}}"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col s3">
		<div id="list-info" class="card hoverable">
			<div class="row" id="info-nav">
				<input type="text" name="shop_name" placeholder="Shop name"  ng-model="selectedShop.name">
			</div>
			<div class="row card-content" id="info-content">
				<ul class="collection">
					<li class="collection-item"><textarea name="shop_description" ng-model="selectedShop.description" rows="50" placeholder="Description"></textarea></li>
					<li class="collection-item"><input type="text" name="shop_url" ng-model="selectedShop.url" placeholder="Homepage"></li>
					<li class="collection-item"><input type="text" name="shop_currency" ng-model="selectedShop.currency" placeholder="Currency"></li>
					<li class="collection-item"><input type="text" name="shop_postel" placeholder="Postel"></li>
				</ul>	
			</div>
			<div class="card-action row">
				<div class="col">
					<br>
					<button class="btn waves-effect waves-light blue hide" id="resetdetails" ng-click="events.viewUser(null,{})">
						<i class="fa fa-random"></i> Clear
					</button>
					<button class="btn waves-effect waves-light green right"  type="submit" title="Generate Password" onclick="updateInfo()">
						<i class="fa fa-floppy-o" aria-hidden="true"></i> @{{ !selectedShop.id ? 'Save' : 'Update' }}
					</button><br><br>
				</div>
			</div>
		</div>
	</div>
</div>
@endcomponent