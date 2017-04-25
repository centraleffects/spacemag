@component('admin.layouts.app')
<div ng-controller="adminShopController">
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

					<div class="card hoverable shopinfo">
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
							<span class="card-title">Login as Owner</span>
							<button class="btn waves-effect waves-light blue" ng-click="events.viewTab('salespot')">
									Click Here
								</button>
						</div>
						<!-- <div class="card-action row">
							<div class="col">
								<button class="btn waves-effect waves-light blue" ng-click="events.viewTab('salespot')">
									Click Here
								</button>
							</div>
						</div> -->
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
	</div>
</div>
@endcomponent