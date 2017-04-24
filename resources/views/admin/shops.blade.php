@component('admin.layouts.app')
<div ng-controller="adminShopController">
<<<<<<< HEAD
	<div id="shop-tab"  ng-show="currentTab == 'shop'">
			<div class="col s3">
				<div class="card hoverable" ng-model="shops">
					<div class="row card-content">
						
						<span class="card-title">Shops</span>
						<div class="collection">
									<a href="#!" 
											class="list-shops collection-item" 
											id="@{{'sh'+ shop.id}}" 
											ng-repeat="(key, shop) in shops.data" 
											ng-click="events.viewShop(this)">
											@{{shop.name}}
									</a>
						</div>
						<span class="badge right"><a href="#!" class="left waves-effect waves-light btn" ng-click="events.addShopSpot()">New Shop</a></span>
					</div>
				</div>	
			</div>
			<div class="col s6">

					<div class="card hoverable">
						<div class="row" id="info-nav">
							<input type="text" name="shop_name" placeholder="Shop name"  ng-model="selectedShop.name">
						</div>
						<div class="row card-content" id="info-content">
							<ul class="collection">
								<li class="collection-item"><textarea name="shop_description" ng-model="selectedShop.description" rows="50" placeholder="Description"></textarea></li>
								<li class="collection-item"><input type="text" name="shop_url" ng-model="selectedShop.url" placeholder="Homepage"></li>
								<li class="collection-item"><input type="text" name="shop_postel" placeholder="Postel"></li>
							</ul>
						</div>
						<div class="row card-content">
							<div class="input-field">
								<select name="currency"   id="currency" ng-model="selectedShop.currency" 
										ng-options="currency.value as currency.text for currency in currencyOptions">
								</select>
								<label>Currency</label>
							</div>
							<div class="input-field">
								<select name="user_id"   id="user_id" ng-model="selectedShop.user_id"
										ng-options="owner.id as owner.name for owner in owners">
										<option value="">Select Owner</option>
								</select>
								<label>Shop Owner</label>
							</div>	
						</div>
					</div>
				</div>
				<div class="col s3">
					<div class="card hoverable">
						<div class="card-action row">
							<button class="btn waves-effect waves-light blue" ng-show="selectedShop.isNew" ng-click="events.cancelSelectedIfNew()">
							 Cancel SHOP
							</button>
							<button class="btn waves-effect waves-light blue" ng-show="!selectedShop.isNew" ng-click="events.deleteSelected()">
							 Delete SHOP
							</button>
							<button class="btn waves-effect waves-light green"  type="submit" ng-click="events.updateSelected()">
								@{{ selectedShop.isNew ? 'Save' : 'Update' }} SHOP
							</button>
						</div>
					</div>

					<div class="card hoverable">
						<div class="row card-content">
							<span class="card-title">Upload Store Floor Plan</span>
						</div>
						<div class="card-action row">
							<div class="col">
								<button class="btn waves-effect waves-light blue" ng-click="events.viewTab('salespot')">
									View Salespot
								</button>
							</div>
						</div>
					</div>	
					
				</div>
	</div>
	<div id="salespot-tab" ng-show="currentTab == 'salespot'">
		@include( 'admin.spots')
=======
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
					<li class="collection-item"><input type="text" name="shop_postel" placeholder="Postel"></li>
				</ul>
			</div>
			<div class="row card-content">
				<div class="input-field">
					<select name="currency"   id="currency" ng-model="selectedShop.currency" 
							ng-options="currency.value as currency.text for currency in currencyOptions">
					</select>
					<label>Currency</label>
				</div>
				<div class="input-field">
					<select name="user_id"   id="user_id" ng-model="selectedShop.user_id"
							ng-options="owner.id as owner.name for owner in owners">
							<option value="">Select Owner</option>
					</select>
					<label>Shop Owner</label>
				</div>	
			</div>
			<div class="card-action row">
				<div class="col">
					<br>
					<button class="btn waves-effect waves-light blue" ng-show="selectedShop.isNew" ng-click="events.cancelSelectedIfNew()">
					 Cancel
					</button>
					<button class="btn waves-effect waves-light blue" ng-show="!selectedShop.isNew" ng-click="events.deleteSelected()">
					 Delete
					</button>
					<button class="btn waves-effect waves-light green right"  type="submit" ng-click="events.updateSelected()">
						@{{ selectedShop.isNew ? 'Save' : 'Update' }}
					</button><br><br>
				</div>
			</div>
		</div>
>>>>>>> parent of df42c63... ADMIN - working on shops
	</div>
</div>
@endcomponent