<div class="row">
	<div class="col s12 card">
		<h2 ng-cloak><small><a class="waves-effect waves-teal btn-flat green-text" ng-click="events.viewTab()"><i class="fa fa-arrow-left" aria-hidden="true"></i> BACK</a></small> @{{selectedShop.name}} </h2>
		
	</div>
</div>
<div class="row">
	<div class="col s3">
		<div class="card hoverable" ng-model="spots">
			<div class="row card-content">
				<span class="card-title">Salespots</span>
				<div class="collection">
					<a href="#!" 
							class="list-spots collection-item" 
							id="@{{'sh'+ spot.id}}" 
							ng-repeat="(key, spot) in spots.data" 
							ng-click="events.viewSpot(this)"
							ng-bind="spot.name">
					</a>
				</div>
				<small ng-show="!spots.data[0].name" ng-cloak>Nothing here. Add a salespot now for @{{selectedShop.name}}</small>
				<span class="badge right"><a href="#!" class="left waves-effect waves-light btn" ng-click="events.addShopSpot()">New Spot</a></span>
			</div>
		</div>		
	</div>
	<div class="col s6 map-area-container" id="mapsection">
		<div class="scrollspy panzoom-parent map-area white" id="floorplan-container">
			<!-- <div class="panzoom" id="spot-panzoom" 
					style="background: url(/floorplan/spots/test_12345.jpg);width: 2426px; height: 1121px;" 
					width="2426" height="1121" data-width="2426" data-height="1121"/>
				<div ng-repeat="(key, spot) in spots.data" 
							class="shopspot tooltipped draggable" 
							id="@{{'spt'+ spot.id}}" 
							data-position="bottom" data-delay="50" 
							ng-show="spots.data"
							ng-click="events.viewSpot(key,spot);"
							data-tooltip="@{{spot.name}}"
							style="@{{ 'margin-left:' + spot.x_coordinate + 'px; margin-top:' + spot.y_coordinate + 'px'}}">
				</div>
			</div> -->
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