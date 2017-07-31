@component('admin.layouts.app')
<div ng-controller="adminShopController as vm">
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
								ng-click="events.viewShop(this)"
								ng-bind="shop.name">
							</a>
						</div>
						<span class="badge right"><a href="#!" class="left waves-effect waves-light btn" ng-click="events.addShop()">New Shop</a></span>
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
							<input type="text" name="url" ng-model="selectedShop.url">
							<label>Homepage</label>
						</div>

						<div class="input-field">
							<input type="text" name="postel"  ng-model="selectedShop.postel">
							<label>Postel</label>
						</div>

						<div class="input-field">
							<select name="currency"   id="currency" ng-model="selectedShop.currency" 
									ng-options="currency.value as currency.text for currency in currencyOptions">
							</select>
							<label>Currency</label>
						</div>

						<div class="input-field">
							<input type="text" name="commission_article_sale" ng-model="selectedShop.commission_article_sale">
							<label>Commission on Article Sale</label>
						</div>

						<div class="input-field">
							<input type="text" name="commission_salespot"  ng-model="selectedShop.commission_salespot">
							<label>Salespot Rebuy Commission</label>
						</div>

					</div>
					<div class="card-action">
						<button class="btn waves-effect waves-light blue" ng-show="selectedShop.isNew" ng-click="events.cancelSelectedIfNew()">
						 Cancel SHOP
						</button>
						<button class="btn waves-effect waves-light blue" ng-show="!selectedShop.isNew" ng-click="events.deleteSelected()">
						 Delete SHOP
						</button>
						<button class="btn waves-effect waves-light green"  type="submit" ng-click="events.updateSelected()" ng-disabled="isUpdatingOwner">
							@{{ selectedShop.isNew ? 'Save' : 'Update' }} SHOP
						</button>
					</div>
				</div>
				<div class="card hoverable">
					<div class="row card-content">
						<span class="card-title">List of Shop Owners</span>
						<table class="bordered highlight"  ng-show="selectedShop.owner.length > 0">
							<tr ng-repeat="owner in selectedShop.owner" >
								<td ng-cloak>@{{owner.email}}</td>
								<td>
									<a href="javascript:;" ng-click="events.loginAsOwner(owner.id)">
									Login as Owner
									</a>  | 
									<a href="javascript:;"  ng-click="vm.removeOwner(owner.email, this)">Remove</a>
								</td>
							</tr>
						</table>
						<div  ng-show="selectedShop.owner.length == 0"><p>None listed.</p></div>
					</div>
				</div>
				<div class="card hoverable">
					<div class="row card-content">
						<span class="card-title">Add New Shop Owner</span>
						<div class="input-field">
							<!-- <input type="hidden" ng-model="selectedShop.newOwner" class="hide"> -->
							<input type="text" name="owner.email" id="owner_email" ng-model="selectedShop.newOwner" placeholder="Enter email to add as owner">
						</div>
						<div id="listofowners-autocomplete" ng-show="owners.length && selectedShop.newOwner.length > 2">
							<div class="collection">
								<a href="javascript:;" 
										class="list-shops collection-item" 
										ng-repeat="owner in owners | filter : selectedShop.newOwner" 
										ng-click="events.changeOwner(owner.email)"
										ng-cloak>
										@{{ owner.name }}
								</a>
							</div>
						</div>
						<p ng-show="(owners | filter : selectedShop.newOwner).length == 0 && selectedShop.newOwner" class="red-text">User doesn't exist. <span class="green-text"><a href="javascript:;;">Account for <b>@{{selectedShop.newOwner}}</b> will be created and will receive an email invitation when you save the changes</a></span></p>
					</div>
					<div class="card-action">
						<button class="btn waves-effect waves-light green"  type="submit" ng-click="events.updateSelected()" ng-disabled="isUpdatingOwner" ng-cloak>
							@{{ selectedShop.isNew ? 'Save' : 'Save Changes' }}
						</button>
					</div>
				</div>
			</div>
			<div class="col s3">
					<!-- <div class="card hoverable">
						<div class="row card-content">
							<span class="card-title">Login as Owner</span>
							<button class="btn waves-effect waves-light blue" ng-click="events.loginAsOwner()">
									Click Here
								</button>
						</div>
					</div>	 -->

				<!-- 	<div class="card hoverable">
						<div class="row card-content">
							<span class="card-title">Upload Store Floor Plan</span>
							<button class="btn waves-effect waves-light blue" ng-click="events.uploadFloorPlan('salespot')">
								Browse File
							</button>
						</div>
					</div>	 -->
					
					<!-- <div class="card hoverable">
						<div class="row card-content">
							<span class="card-title">Email Invitation</span>
							<button class="btn waves-effect waves-light blue" ng-click="events.sendEmailInvitation">
								Send
							</button>
						</div>
					</div> -->	

				</div>
	</div>
</div>
@endcomponent