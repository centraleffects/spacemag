@component('shop_owner.layouts.app')
	<div ng-controller="dashboardController">
	<div id="shop-tab"  ng-show="currentTab == 'shop'">
			<div class="col s3">
				<div class="card hoverable" ng-model="shops">
					<div class="row card-content">
						
						<span class="card-title">Shops</span>
						<div class="collection">
									<a href="javascript:;" 
											class="list-shops collection-item" 
											id="@{{'sh'+ shop.id}}" 
											ng-repeat="(key, shop) in shops.data" 
											ng-click="events.viewShop(this)">
											@{{shop.name}}
									</a>
						</div>
					</div>
				</div>	
			</div>
			<div class="col s6">

					<div class="card hoverable shopinfo">
						<div class="row card-content">
							<span class="card-title">Shop Information</span><br>
							<div class="input-field">
								<input type="text" name="shop_name" ng-model="selectedShop.name">
								<label>Name</label>
							</div>

							<div class="input-field">
								<textarea name="shop_description" ng-model="selectedShop.description" class="materialize-textarea"></textarea>
								<label>Description</label>
							</div>

							<div class="input-field">
								<input type="text" name="shop_url" ng-model="selectedShop.url">
								<label>Homepage</label>
							</div>

							<div class="input-field">
								<input type="text" name="shop_postel">
								<label>Postel</label>
							</div>

							<div class="input-field">
								<select name="currency"   id="currency" ng-model="selectedShop.currency" 
										ng-options="currency.value as currency.text for currency in currencyOptions">
								</select>
								<label>Currency</label>
							</div>

							<div class="input-field">
								<input type="text" name="shop_postel">
								<label>Commission on Article Sale</label>
							</div>

							<div class="input-field">
								<input type="text" name="shop_postel">
								<label>Salespot Rebuy Commission</label>
							</div>

						</div>
					</div>

				</div>
				<div class="col s3">
					<div class="card hoverable">
						<div class="card-action row">
							<button class="btn waves-effect waves-light green"  type="submit" ng-click="events.updateSelected()">
								UPDATE SHOP INFORMATION
							</button>
						</div>
					</div>

					<div class="card hoverable">
						<div class="row card-content">
							<span class="card-title">Upload Store Floor Plan</span>
							<button class="btn waves-effect waves-light blue" ng-click="events.viewTab('salespot')">
								View Salespot
							</button>
							<a href="javascript:;;" onclick="document.getElementById(\"browsefile\").click()"> Browse Floor Plan</a>
							<input type="file" id="uploadFloorplan" name="uploadFloorplan" style="display:none">
						</div>
					</div>	
					
					<div class="card hoverable">
						<div class="row card-content">
							<span class="card-title">Email Invitation</span>
							<button class="btn waves-effect waves-light blue" ng-click="events.sendEmailInvitation">
								Send
							</button>
						</div>
					</div>	
				</div>
	</div>
	<div id="salespot-tab" ng-show="currentTab == 'salespot'">
		@include( 'shop_owner.spots')
	</div>
</div>

@endcomponent