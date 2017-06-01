@component('shop_owner.layouts.app')
@slot('controller') ng-controller="dashboardController" @endslot
<!-- <div ng-controller="dashboardController"> -->
	<div id="shop-tab">
		<!-- <div class="col s3"> -->
		@slot('left')
			<!-- <div class="card hoverable" ng-model="shops">
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
			</div>	 -->

			<div class="card hoverable" ng-model="workers">
				<div class="row card-content">

					<span class="card-title">Workers</span>
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

		<!-- </div> -->
		@endslot
		<!-- <div class="col s6"> -->
		@slot('center')

			<div class="card hoverable shopinfo">
				<div class="row card-content">
					<ul class="tabs">
						<li class="tab active">
							<a class="card-title" href="#shop_general_info">Shop Information</a>
						</li>
						<li class="tab">
							<a class="card-title" href="#shop_settings">Shop Settings</a>
						</li>
					</ul>

					<div id="shop_general_info">
						<br/>
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

					<div id="shop_settings" style="display: none;">
						<p class="lead">Services</p>
						<div class="input-field">
							
							<!-- <select name="cleaning_schedule" multiple>
								<option value="all">Everyday</option>
								<option value="mon">Monday</option>
								<option value="tue">Tuesday</option>
								<option value="wed">Wednesday</option>
								<option value="thu">Thursday</option>
								<option value="fri">Friday</option>
								<option value="sat">Saturday</option>
								<option value="sun">Sunday</option>
							</select> -->
							<label>Cleaning</label>
						</div>
					</div>

				</div>
			</div>

		<!-- </div> -->
		@endslot
		@slot('right')
		<!-- <div class="col s3"> -->
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
		<!-- </div> -->
		@endslot
	</div>
<!-- </div> -->

@endcomponent