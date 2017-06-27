@component('shop_owner.layouts.app')
<div class="row"  ng-controller="spotsController as vm">
	<div class="col s3">
		<div class="card hoverable">
			<div class="row card-content">
				<span class="card-title">Salespots - {{!empty(session()) ? session()->get("selected_shop")->name : ''}}</span>
				<div class="nav-wrapper">
			      <form>
			        <div class="input-field">
			          <input id="search" type="search" required ng-model="vm.spotquery">
			          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
			          <i class="material-icons">close</i>
			        </div>
			      </form>
			    </div>
			    <div><a href="javascript:;"> &nbsp; <a href="javascript:;" ng-click="events.addSaleSpot(null,null)"><span class="badge">New Spot</span></a></div>
				<div class="collection list-spots" ng-show="spots.data.length > 0">
					<a href="javascript:;" 
							class="collection-item" 
							id="@{{'sh'+ spot.id}}" 
							ng-repeat="(key, spot) in spots.data | convertArray | filter : vm.spotquery" 
							ng-click="events.viewSpot(this)"
							>@{{spot.name}} 
					</a>
				</div>
				<small ng-show="!spots.data[0].name"><br>Nothing here. Add a salespot now for {{session()->get("selected_shop")->name}}</small>
			</div>
		</div>		
	</div>
	<div class="col s6">
		<div class="map-area-container" id="mapsection">
			<div class="scrollspy panzoom-parent map-area white" id="floorplan-container">
				<div class="panzoom" id="spot-panzoom" 
						style="background: url(/floorplan/spots/test_12345.jpg);width: 400px; height: 400px;" 
						width="400" height="400" data-width="400" data-height="400"/>
					<div ng-repeat="(key, spot) in spots.data | convertArray | filter : vm.FilterSpotDisplay" 
								class="shopspot tooltipped draggable @{{vm.spotTypeColors[spot.type]}}" 
								id="@{{'spt'+ spot.id}}" 
								data-position="bottom" data-delay="50" 
								ng-show="spot.spot_x && spot.spot_y"
								ng-click="events.viewSpot(this);"
								data-tooltip="@{{spot.name}}"
								style="@{{ 'margin-left:' + spot.spot_x + 'px; margin-top:' + spot.spot_y + 'px'}}">
					</div>
				</div>
			</div>
		</div>
		<div class="card hoverable">
			<div class="row card-content">
				<span class="card-title">Filter by spot types</span>
				<table>
					<tr>
						<td><div class="spot-index pink"></div> <a href="javascript:;" ng-click="vm.FilterSpotDisplay ='hanger'" class="@{{ (vm.FilterSpotDisplay =='hanger') ? 'underlined green-text' : ''}}">Hanger</a></td>
						<td><div class="spot-index orange"></div> <a href="javascript:;" ng-click="vm.FilterSpotDisplay ='shelves'" class="@{{ (vm.FilterSpotDisplay =='shelves') ? 'underlined green-text' : ''}}">Shelves</a></td>
						<td><div class="spot-index yellow"></div> <a href="javascript:;" ng-click="vm.FilterSpotDisplay ='standard'" class="@{{ (vm.FilterSpotDisplay =='standard') ? 'underlined green-text' : ''}}">Standard</a></td>
						<td><div class="spot-index blue"></div> <a href="javascript:;" ng-click="vm.FilterSpotDisplay ='wall'" class="@{{ (vm.FilterSpotDisplay =='wall') ? 'underlined green-text' : ''}}">Wall Section</a></td>
						<td><div class="spot-index"></div> <a href="javascript:;" ng-click="vm.FilterSpotDisplay =''"  class="@{{ (vm.FilterSpotDisplay =='') ? 'underlined green-text' : ''}}">All</a></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="card hoverable">
			<div class="row card-content"  ng-show="!selectedSpot.name">
				<span class="card-title" ng-cloak>Filter by bookings</span>
				
			</div>
		</div>
		<div class="card hoverable" ng-show="selectedSpot.name">
			<div class="row card-content">
				<span class="card-title" ng-cloak>Bookings for @{{selectedSpot.name}}</span>
				
			</div>
		</div>
		<div class="card hoverable"  ng-show="selectedSpot.name">
			<div class="row card-content">
					<div class="input-field col s12">
						<span class="card-title" ng-cloak>Set Prices for @{{selectedSpot.name}}</span>
						
						<div class="input-field">
							<input type="text" name="daily" ng-model="selectedSpot.prices.daily">
							<label>Daily</label>
						</div>

						<div class="input-field">
							<input type="text" name="weekly1" ng-model="selectedSpot.prices.week1">
							<label>1 Week</label>
						</div>

						<div class="input-field">
							<input type="text" name="weekly2" ng-model="selectedSpot.prices.week2">
							<label>2 Weeks</label>
						</div>

						<div class="input-field">
							<input type="text" name="weekly3" ng-model="selectedSpot.prices.week3">
							<label>3 Weeks</label>
						</div>

						<div class="input-field">
							<input type="text" name="weekly4" ng-model="selectedSpot.prices.week4">
							<label>4 Weeks</label>
						</div>

					</div>
				</div>
			</div>
		</div>
	<!-- 	<div class="card hoverable"  ng-show="selectedSpot.name">
			<div class="row card-content">
				<div class="input-field col s12">
					<span class="card-title">Apply Categories for this Spot</span>
					<div id="categoriess" class="fNULLorm-control" ng-model="selectedSpot.selectedCategories" 
							data-placeholder="Type a category" data-allow-clear="true">
				      <a
				      			ng-repeat="(key, category) in categories.data"
				      			id="@{{'cat'+ category.id}}"
								value="@{{category.id}}">@{{category.name}}</a>
				    </div>
					<select id="categories" class="form-control" ng-model="selectedSpot.selectedCategories" 
							data-placeholder="Type a category" multiple="true" data-allow-clear="true">
				      <option
				      			ng-repeat="(key, category) in categories.data"
				      			id="@{{'cat'+ category.id}}"
								value="@{{category.id}}">@{{category.name}}</option>
				    </select>
				</div>
			</div>
		</div>	 
	</div>-->
	<div class="col s3">
		<div class="card hoverable shopinfo"  ng-show="selectedSpot.name">
			<div class="row card-content">
				<span class="card-title">Spot Information</span>
				<div class="input-field">
					<input type="text" name="name" ng-model="selectedSpot.name">
					<label>Name</label>
				</div>

				<div class="input-field">
					<textarea name="description" ng-model="selectedSpot.description" class="materialize-textarea"></textarea>
					<label>Description</label>
				</div>

				<div class="input-field">
					<input type="text" name="spot_code" ng-model="selectedSpot.spot_code">
					<label>Spot Code</label>
				</div>

				<div class="row">
					<div class="col s9">
						<div class="input-field">
							<label>Location</label><br>
							<input type="text" name="spot_location" ng-model="selectedSpot.spot_location" disabled="disabled" title="Spot Location">
							
						</div>
					</div>
					<div class="col s3">
						<a href="javascript:;" style="position: absolute;margin-top: 40px;" ng-click="events.changeSpotLocation()" ng-show="selectedSpot.spot_location">Change</a>
						<a href="javascript:;" style="position: absolute;margin-top: 40px;" ng-click="events.changeSpotLocation()" ng-show="!selectedSpot.spot_location">Add</a>
					</div>
				</div>

				<div class="input-field">
					<input type="text" name="aisle" ng-model="selectedSpot.aisle">
					<label>Aisle</label>
				</div>

				<div class="input-field">
					<input type="text" name="size" ng-model="selectedSpot.size">
					<label>Size</label>
				</div>

				<div class="input-field">
					<select name="status"   id="status" ng-model="selectedSpot.type" 
							ng-options="status.value as status.text for status in spotTypeOptions">
					</select>
					<label>Type</label>
				</div>

				<div class="input-field">
					<select name="status"   id="status" ng-model="selectedSpot.status" 
							ng-options="status.value as status.text for status in spotStatusOptions">
					</select>
					<label>Status</label>
				</div>


			</div>
			<div class="card-action row">
					<div class="col">
						<button class="btn waves-effect waves-light blue" ng-show="selectedSpot.isNew && !empty(selectedSpot)" ng-click="events.cancelSelectedSpotIfNew()">
						 Cancel
						</button>
						<button class="btn waves-effect waves-light blue" ng-show="selectedSpot.id && !selectedSpot.isNew" ng-click="events.deleteSelectedSpot()">
						 Delete
						</button> 
						<button class="btn waves-effect waves-light green"  type="submit" ng-click="events.updateSelected()"   ng-show="selectedSpot.name">
							@{{ (!selectedSpot.isNew) ?  'Update' : 'Save' }}
						</button> 	
						<button class="btn waves-effect waves-light blue" ng-show="!selectedSpot.name" ng-click="events.addSaleSpot(null,null)">
						 New
						</button>
					</div>
			</div>
		</div>
	</div>
</div>
@endcomponent