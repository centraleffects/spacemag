@component('shop_owner.layouts.app')
<div class="row"  ng-controller="spotsController as vm">
	<div class="col s3">
		<div class="card hoverable">
			<div class="row card-content">
				<span class="card-title">Salespots - {{!empty(session()) ? session()->get("selected_shop")->name : ''}}</span>
				<div class="nav-wrapper">
			      <form>
			        <div class="input-field">
			          <input id="search" type="search" required>
			          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
			          <i class="material-icons">close</i>
			        </div>
			      </form>
			    </div>
			    <div><a href="javascript:;">Filter Result <a href="javascript:;" ng-click="events.addSaleSpot(null,null)"><span class="badge">New Spot</span></a></div>
				<div class="collection list-spots" ng-show="spots.data.length > 0">
					<a href="javascript:;" 
							class="collection-item" 
							id="@{{'sh'+ spot.id}}" 
							ng-repeat="(key, spot) in spots.data" 
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
					<div ng-repeat="(key, spot) in spots.data" 
								class="shopspot tooltipped draggable" 
								id="@{{'spt'+ spot.id}}" 
								data-position="bottom" data-delay="50" 
								ng-show="spot.x_coordinate && spot.y_coordinate"
								ng-click="events.viewSpot(key,spot);"
								data-tooltip="@{{spot.name}}"
								style="@{{ 'margin-left:' + spot.x_coordinate + 'px; margin-top:' + spot.y_coordinate + 'px'}}">
					</div>
				</div>
			</div>
		</div>
		<div class="card hoverable"  ng-show="selectedSpot.name">
			<div class="row card-content">
				<div class="input-field col s12">
					<span class="card-title">Apply Categories for this Spot</span>
					<p ng-repeat="(key, category) in categories.data">
				      <input type="checkbox" 
				      				id="@{{'cat'+ category.id}}"
									ng-value="category.id"
									ng-model="selectedSpot.categories"
									ng-checked="vm.checkSelectedSpotCategory(category.id)"/>
				      <label for="@{{'cat'+ category.id}}" ng-bind="category.name"></label>
				    </p>
				</div>
			</div>
		</div>	
	</div>
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
							<input type="text" name="spot_location" ng-model="selectedSpot.spot_location" disabled="disabled" title="Spot Location">
						</div>
					</div>
					<div class="col s3">
						<a href="javascript:;" style="position: absolute;margin-top: 40px;" ng-click="events.changeSpotLocation()" >Change</a>
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