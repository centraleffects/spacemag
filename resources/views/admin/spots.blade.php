@component('admin.layouts.app')
<div ng-controller="adminSpotController" id="spots">
	<div class="col s3">
		<div  class="white" id="dashleft-sidebar" ng-model="shops">
			<ul class="collapsible" data-collapsible="accordion">
				<li>
			      <div class="collapsible-header"><h5><i class="material-icons">arrow_drop_down_circle</i>  Shops - @{{selectedShop.name}}</h5></div>
			      <div class="collapsible-body">
			      		<ul class="collection" ng-repeat="(key, shop) in shops.data">
							<li id="@{{'sh'+ shop.id}}" class="collection-item" ng-click="events.viewShop(key,shop)">
								<span><a href="">@{{shop.name}}</a></span> 
								<a href="#">
									<i class="tiny material-icons">call_made</i>
								</a>
							</li>					
						</ul>
			      </div>
			    </li>
			    <li id="salespot" class="active">
			      <div class="collapsible-header">
			      		<h5><i class="material-icons">arrow_drop_down_circle</i>  Spots 
			      			<span ng-show="selectedSpot.name">-</span> @{{selectedSpot.name}}
			      		</h5>
			      </div>
			      <div class="collapsible-body">
			      		<ul class="collection" ng-repeat="(key, spot) in spots.data">
							<li id="@{{'sp'+ spot.id}}" class="collection-item" ng-click="events.viewSpot(key,spot)">
								<span><a href="">@{{spot.name}}</a></span> 
								<a href="#">
									<i class="tiny material-icons">call_made</i>
								</a>
							</li>					
						</ul>
						<small ng-show="!spots.data[0].name">Nothing here. Add a salespot now for @{{selectedShop.name}}</small>
			      </div>
			    </li>
			</ul>		
		</div>
	</div>
	<div class="col s6 map-area-container" id="mapsection">
		<div class="scrollspy panzoom-parent map-area" id="floorplan-container">
			<div class="panzoom" id="spot-panzoom" style="background: url(/floorplan/spots/test_12345.jpg);width: 2426px; height: 1121px;" width="2426" height="1121" data-width="2426" data-height="1121"/>
				<div ng-repeat="(key, spot) in spots.data">
					<div class="shopspot tooltipped" 
							id="@{{'spt'+ spot.id}}" 
							data-position="bottom" data-delay="50" 
							ng-show="spot.x_coordinate"
							ng-click="events.viewSpot(key,spot);"
							data-tooltip="@{{spot.name}}" 
							style="@{{ 'margin-left:' + spot.x_coordinate + 'px; margin-top:' + spot.y_coordinate + 'px'}}"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col s3">
		<div id="list-info" class="card hoverable">
			<div class="row" id="info-nav">
				<input type="text" name="name" placeholder="Spot name"  ng-model="selectedSpot.name">
			</div>
			<div class="row card-content" id="info-content">
				<ul class="collection">
					<li class="collection-item"><textarea name="description" ng-model="selectedSpot.description" rows="50" placeholder="Description"></textarea></li>
					<li class="collection-item"><input type="text" name="shop_url" ng-model="selectedSpot.url" placeholder="Homepage"></li>
					<li class="collection-item"><input type="text" name="shop_postel" placeholder="Postel"></li>
				</ul>
			</div>
			<div class="row card-content">
				<div class="input-field">
					<select name="currency"   id="currency" ng-model="selectedSpot.currency" 
							ng-options="currency.value as currency.text for currency in currencyOptions">
					</select>
					<label>Currency</label>
				</div>
				<div class="input-field">
					<select name="user_id"   id="user_id" ng-model="selectedSpot.user_id"
							ng-options="owner.id as owner.name for owner in owners">
							<option value="">Select Owner</option>
					</select>
					<label>Shop Owner</label>
				</div>	
			</div>
			<div class="card-action row">
				<div class="col">
					<br>
					<button class="btn waves-effect waves-light blue" ng-show="selectedSpot.isNew" ng-click="events.cancelSelectedIfNew()">
					 Cancel
					</button>
					<button class="btn waves-effect waves-light blue" ng-show="!selectedSpot.isNew" ng-click="events.deleteSelected()">
					 Delete
					</button>
					<button class="btn waves-effect waves-light green right"  type="submit" ng-click="events.updateSelected()">
						@{{ selectedSpot.isNew ? 'Save' : 'Update' }}
					</button><br><br>
				</div>
			</div>
		</div>
	</div>
</div>
@endcomponent